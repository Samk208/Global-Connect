jQuery(document).ready(function ($) {

    // Inject Chat UI if not present
    if ($('#gc-chat-widget').length === 0) {
        $('body').append(`
            <div id="gc-chat-widget" class="gc-chat-closed" role="complementary" aria-label="Chat Assistant">
                <div class="gc-chat-header">
                    <div class="gc-chat-title">
                        <span class="gc-status-dot" aria-hidden="true"></span>
                        <span>Global Connect Assistant</span>
                    </div>
                    <div class="gc-chat-controls">
                        <a href="https://wa.me/${gc_chat_obj.whatsapp || '12672900254'}" target="_blank" class="gc-handover-btn" title="Talk to a Human" aria-label="Switch to WhatsApp chat">
                            <span class="dashicons dashicons-whatsapp" aria-hidden="true"></span>
                        </a>
                        <button class="gc-chat-toggle" aria-label="Minimize chat"><span class="dashicons dashicons-arrow-down-alt2" aria-hidden="true"></span></button>
                    </div>
                </div>
                <div class="gc-chat-body" id="gc-chat-messages" role="log" aria-live="polite" aria-label="Chat messages">
                    <div class="gc-chat-msg bot">
                        Hello! I can help you with shipping rates, inventory, and tracking. How can I assist you today?
                    </div>
                </div>
                <div class="gc-chat-input-area">
                    <input type="text" id="gc-chat-input" placeholder="Type a message..." aria-label="Type your message" />
                    <button id="gc-chat-send" aria-label="Send message"><span class="dashicons dashicons-paperplane" aria-hidden="true"></span></button>
                </div>
                <button class="gc-chat-launcher" aria-label="Open chat assistant">
                    <span class="dashicons dashicons-format-chat" aria-hidden="true"></span>
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
    var isSending = false;

    function sendMessage() {
        const msg = $input.val().trim();
        if (!msg || isSending) return;

        isSending = true;
        $input.prop('disabled', true);
        $sendBtn.prop('disabled', true).attr('aria-busy', 'true');

        // Append User Msg
        $messages.append(`<div class="gc-chat-msg user">${escapeHtml(msg)}</div>`);
        $input.val('');
        scrollToBottom();

        // Show Typing indicator
        const $typing = $(`<div class="gc-chat-msg bot typing"><span class="gc-typing-dots"><span></span><span></span><span></span></span></div>`);
        $messages.append($typing);
        scrollToBottom();

        // Gather History (Last 5 messages)
        const history = [];
        $messages.find('.gc-chat-msg').not('.typing').slice(-6, -1).each(function () {
            const $this = $(this);
            const role = $this.hasClass('user') ? 'user' : 'assistant';
            const content = $this.text().trim();
            if (content) history.push({ role, content });
        });

        function enableInput() {
            isSending = false;
            $input.prop('disabled', false).focus();
            $sendBtn.prop('disabled', false).removeAttr('aria-busy');
        }

        // Call API with retry
        function callApi(retries) {
            $.ajax({
                url: '/wp-json/gc/v1/chat',
                method: 'POST',
                contentType: 'application/json',
                timeout: 15000,
                data: JSON.stringify({
                    message: msg,
                    history: history
                }),
                success: function (response) {
                    $typing.remove();
                    if (response.reply) {
                        // Conversion Logic: If the bot suggests a quote or invoice, add a button
                        var cleanReply = escapeHtml(response.reply).replace(/\n/g, '<br>');

                        var triggerKeywords = ['quote', 'invoice', 'pro-forma', 'pricing', 'cost to ship', 'shipping cost'];
                        var lowerReply = response.reply.toLowerCase();
                        var shouldShowWizard = triggerKeywords.some(function(kw) { return lowerReply.indexOf(kw) !== -1; });

                        var html = '<div class="gc-chat-msg bot">' + cleanReply;
                        if (shouldShowWizard && $('#gc-wizard-modal').length > 0) {
                            html += '<div class="gc-chat-action-area"><button class="gc-chat-wizard-btn"><span class="dashicons dashicons-calculator"></span> Open Inquiry Wizard</button></div>';
                        }
                        html += '</div>';

                        $messages.append(html);

                        // Add listener for the new button
                        $messages.find('.gc-chat-wizard-btn').last().on('click', function() {
                            toggleChat(); // Close chat
                            $('#gc-wizard-modal').fadeIn(); // Open Wizard
                        });

                    } else {
                        $messages.append('<div class="gc-chat-msg bot error">Sorry, I didn\'t get that.</div>');
                    }
                    enableInput();
                    scrollToBottom();
                },
                error: function () {
                    if (retries > 0) {
                        setTimeout(function() { callApi(retries - 1); }, 1500);
                        return;
                    }
                    $typing.remove();
                    $messages.append('<div class="gc-chat-msg bot error">Connection error. Please try again.</div>');
                    enableInput();
                    scrollToBottom();
                }
            });
        }

        callApi(1); // 1 retry on failure
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
