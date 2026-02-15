
import os
import sys
import argparse
import json

try:
    import google.generativeai as genai
except ImportError:
    print("Error: 'google-generativeai' library is required.")
    sys.exit(1)

API_KEY = os.getenv("GEMINI_API_KEY")
if not API_KEY:
    print("Warning: GEMINI_API_KEY not set. Cannot use Gemini. Using fallback mock.")
else:
    genai.configure(api_key=API_KEY)

def generate_schema(content, schema_type, model_name='gemini-2.0-flash'):
    if not API_KEY:
        # Mock Response
        print(f"/* Mock Schema for {schema_type} */")
        mock = {
            "@context": "https://schema.org",
            "@type": schema_type,
            "name": "Example Schema",
            "description": "Generated without API key."
        }
        print(json.dumps(mock, indent=2))
        return

    prompt = f"""
    Generate valid JSON-LD schema markup for a page based on the following content.
    Target Schema Type: {schema_type}
    
    Content:
    {content[:8000]}... (truncated if too long)
    
    Output ONLY valid JSON. do not include markdown blocks like ```json ... ```.
    Ensure strict Schema.org compliance.
    """
    
    try:
        model = genai.GenerativeModel(model_name)
        response = model.generate_content(prompt)
        # simplistic cleanup
        output = response.text.strip()
        if output.startswith("```json"):
            output = output[7:]
        if output.endswith("```"):
            output = output[:-3]
        print(output.strip())
        
    except Exception as e:
        print(f"Error generating schema: {e}")

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Generate JSON-LD Schema using Gemini.")
    parser.add_argument("content_file", help="Path to text file containing content")
    parser.add_argument("--type", default="WebPage", help="Schema Type (Product, FAQPage, etc)")
    
    args = parser.parse_args()
    
    if os.path.exists(args.content_file):
        with open(args.content_file, 'r', encoding='utf-8') as f:
            content = f.read()
        generate_schema(content, args.type)
    else:
        print(f"File not found: {args.content_file}")
