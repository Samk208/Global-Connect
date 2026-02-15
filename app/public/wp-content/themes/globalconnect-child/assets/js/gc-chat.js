jQuery(document).ready(function ($) {

    // Inject Chat UI if not present
    if ($('#gc-chat-widget').length === 0) {
        $('body').append(`
            <div id="gc-chat-widget" class="gc-chat-closed">
                <div class="gc-chat-header">
                    <div class="gc-chat-title">
                        <span class="gc-status-dot"></span>
                        <span>Global Connect Assistant</span>
                    </div>
                    <div class="gc-chat-controls">
                        <a href="https://wa.me/${gc_chat_obj.whatsapp || '12672900254'}" target="_blank" class="gc-handover-btn" title="Talk to a Human">
                            <span class="dashicons dashicons-whatsapp"></span>
                        </a>
                        <button class="gc-chat-toggle"><span class="dashicons dashicons-arrow-down-alt2"></span></button>
                    </div>
                </div>
                <div class="gc-chat-body" id="gc-chat-messages">
                    <div class="gc-chat-msg bot">
                        Hello! I can help you with shipping rates, inventory, and tracking. How can I assist you today?
                    </div>
                </div>
                <div class="gc-chat-input-area">
                    <input type="text" id="gc-chat-input" placeholder="Type a message..." />
                    <button id="gc-chat-send"><span class="dashicons dashicons-paperplane"></span></button>
                </div>
                <button class="gc-chat-launcher">
                    <span class="dashicons dashicons-format-chat"></span>
                </button>
            </div>
        `);
    }

    const $widget = $('#gc-chat-widget');
    const $launcher = $widget.find('.gc-chat-launcher');
    const $toggle = $widget.find('.gc-chat-toggle');
    const $messages = $('#gc-chat-messages');
    const $input = $('#gc-chat-input');
    const $sendBtn = $('#gc-chat-send');

    // Toggle Chat
    function toggleChat() {
        $widget.toggleClass('gc-chat-closed gc-chat-open');
    }
    $launcher.on('click', toggleChat);
    $toggle.on('click', toggleChat);

    // Send Message Logic
    function sendMessage() {
        const msg = $input.val().trim();
        if (!msg) return;

        // Append User Msg
        $messages.append(`<div class="gc-chat-msg user">${escapeHtml(msg)}</div>`);
        $input.val('');
        scrollToBottom();

        // Show Typing
        const $typing = $(`<div class="gc-chat-msg bot typing">Thinking...</div>`);
        $messages.append($typing);
        scrollToBottom();

        // Gather History (Last 5 messages)
        const history = [];
        $messages.find('.gc-chat-msg').slice(-6, -1).each(function () {
            const $this = $(this);
            const role = $this.hasClass('user') ? 'user' : 'assistant';
            const content = $this.text().replace('Thinking...', '').trim();
            if (content) history.push({ role, content });
        });

        // Call API
        $.ajax({
            url: '/wp-json/gc/v1/chat',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                message: msg,
                history: history
            }),
            success: function (response) {
                $typing.remove();
                if (response.reply) {
                    // Conversion Logic: If the bot suggests a quote or invoice, add a button
                    let cleanReply = escapeHtml(response.reply).replace(/\n/g, '<br>');
                    
                    const triggerKeywords = ['quote', 'invoice', 'pro-forma', 'pricing', 'cost to ship', 'shipping cost'];
                    const lowerReply = response.reply.toLowerCase();
                    const shouldShowWizard = triggerKeywords.some(kw => lowerReply.includes(kw));

                    let html = `<div class="gc-chat-msg bot">${cleanReply}`;
                    if (shouldShowWizard && $('#gc-wizard-modal').length > 0) {
                        html += `<div class="gc-chat-action-area">
                            <button class="gc-chat-wizard-btn">
                                <span class="dashicons dashicons-calculator"></span> Open Inquiry Wizard
                            </button>
                        </div>`;
                    }
                    html += `</div>`;
                    
                    $messages.append(html);

                    // Add listener for the new button
                    $messages.find('.gc-chat-wizard-btn').last().on('click', function() {
                        toggleChat(); // Close chat
                        $('#gc-wizard-modal').fadeIn(); // Open Wizard
                    });

                } else {
                    $messages.append(`<div class="gc-chat-msg bot error">Sorry, I didn't get that.</div>`);
                }
                scrollToBottom();
            },
            error: function () {
                $typing.remove();
                $messages.append(`<div class="gc-chat-msg bot error">Connection error. Please try again.</div>`);
                scrollToBottom();
            }
        });
    }

    $sendBtn.on('click', sendMessage);
    $input.on('keypress', function (e) {
        if (e.which === 13) sendMessage();
    });

    function scrollToBottom() {
        $messages.scrollTop($messages[0].scrollHeight);
    }

    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }

});
