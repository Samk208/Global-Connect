
import os
import sys
import argparse

try:
    import google.generativeai as genai
except ImportError:
    print("Error: 'google-generativeai' library is required.")
    print("Please install it running: pip install google-generativeai")
    sys.exit(1)

API_KEY = os.getenv("GEMINI_API_KEY")
if not API_KEY:
    print("Warning: GEMINI_API_KEY env var not set. Using mock output.")
else:
    genai.configure(api_key=API_KEY)

def generate_seo(content, post_id, model_name='gemini-2.0-flash'):
    if not API_KEY:
        print(f"# Simulating WP-CLI output for Post ID: {post_id}")
        keyword = "Sample Keyword"
        title = "Example SEO Optimized Title"
        desc = "This is a sample meta description under 160 characters."
    else:
        # Use Gemini to generate the SEO data
        prompt = f"""
        Analyze the following content and provide:
        1. A primary RankMath Focus Keyword based on semantic relevance.
        2. An SEO Title (max 60 chars).
        3. A Meta Description (max 160 chars).

        Content:
        {content[:5000]}... (truncated)

        Output as specific WP-CLI commands only. No markdown formatting.
        Format:
        wp post meta update {post_id} rank_math_focus_keyword "KEYWORD"
        wp post meta update {post_id} rank_math_title "TITLE"
        wp post meta update {post_id} rank_math_description "DESCRIPTION"
        """
        
        try:
            model = genai.GenerativeModel(model_name)
            response = model.generate_content(prompt)
            print(response.text)
            return
        except Exception as e:
            print(f"Error generating content: {e}")
            return

    # Fallback/Mock output format
    print(f'wp post meta update {post_id} rank_math_focus_keyword "{keyword}"')
    print(f'wp post meta update {post_id} rank_math_title "{title}"')
    print(f'wp post meta update {post_id} rank_math_description "{desc}"')

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Generate RankMath SEO meta using Gemini.")
    parser.add_argument("content_file", help="Path to text file containing post content")
    parser.add_argument("--post_id", default="<ID>", help="WordPress Post ID")
    
    args = parser.parse_args()
    
    if os.path.exists(args.content_file):
        with open(args.content_file, 'r', encoding='utf-8') as f:
            content = f.read()
        generate_seo(content, args.post_id)
    else:
        print(f"File not found: {args.content_file}")
