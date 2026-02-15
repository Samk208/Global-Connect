
import json
import sys
import re

def extract_css(json_path):
    print(f"Reading {json_path}...")
    try:
        with open(json_path, 'r', encoding='utf-8') as f:
            data = json.load(f)
    except Exception as e:
        print(f"Error loading JSON: {e}")
        return

    css_found = []
    
    # Recursive search for 'custom_css' or similar fields
    def find_css(obj, path="root"):
        if isinstance(obj, dict):
            for k, v in obj.items():
                if isinstance(v, (dict, list)):
                    find_css(v, f"{path}->{k}")
                elif "css" in k.lower() and isinstance(v, str) and v.strip():
                    # Check if it looks like CSS
                    if '{' in v or ':' in v:
                         css_found.append(f"/* Path: {path}->{k} */\n{v}\n")
        elif isinstance(obj, list):
            for i, item in enumerate(obj):
                find_css(item, f"{path}[{i}]")

    find_css(data)
    
    if css_found:
        output_file = json_path.replace('.json', '_extracted.css')
        with open(output_file, 'w', encoding='utf-8') as out:
            out.writelines(css_found)
        print(f"Extracted {len(css_found)} CSS blocks to {output_file}")
    else:
        print("No inline Custom CSS found in this export.")

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Usage: python extract_css.py <path_to_divi_json>")
        sys.exit(1)
        
    extract_css(sys.argv[1])
