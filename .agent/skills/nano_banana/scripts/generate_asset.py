import os
import sys
import argparse
import time
import base64
import json
from dotenv import load_dotenv

# Try to load env from file if possible, for local dev convenience
load_dotenv()

# Check for google-generativeai
try:
    import google.generativeai as genai
except ImportError:
    print("Warning: 'google-generativeai' library not found. Will try REST fallback.")
    genai = None

# Default configuration
API_KEY = os.getenv("GEMINI_API_KEY") or os.getenv("GOOGLE_API_KEY")
DEFAULT_MODEL = os.getenv("GEMINI_IMAGE_MODEL", "imagen-3.0-generate-001")

def generate_image(prompt, output_file="generated_image.png"):
    print(f"Generating image for: '{prompt}'")
    
    if not API_KEY:
        print("[WARNING] GEMINI_API_KEY environment variable not set.")
        print("Please set GEMINI_API_KEY in your .env to use Google's image generation.")
        print("Mock mode: Saving text file instead.")
        with open(output_file + ".txt", 'w') as f:
            f.write(f"PLACEHOLDER FOR: {prompt}\n(Set GEMINI_API_KEY to generate real images)")
        return

    # Try SDK first if available and looks capable
    sdk_success = False
    if genai:
        try:
            # Patch for SDK versions where ImageGenerationModel is not exposed at top level
            if not hasattr(genai, "ImageGenerationModel"):
                try:
                    from google.generativeai.image import ImageGenerationModel
                    setattr(genai, "ImageGenerationModel", ImageGenerationModel)
                    print("Patched genai.ImageGenerationModel from google.generativeai.image")
                except ImportError:
                    pass

            if hasattr(genai, "ImageGenerationModel"):
                print(f"Using SDK ImageGenerationModel ({DEFAULT_MODEL})...")
                genai.configure(api_key=API_KEY)
                model = genai.ImageGenerationModel(DEFAULT_MODEL)
                response = model.generate_images(
                    prompt=prompt,
                    number_of_images=1,
                    aspect_ratio="1:1",
                    safety_filter_level="block_only_high",
                    person_generation="allow_adult",
                )
                
                if response.images:
                    image = response.images[0]
                    print(f"Image generated! Saving to {output_file}...")
                    image.save(output_file)
                    print("Done.")
                    sdk_success = True
                else:
                    print("No images returned from SDK.")
            else:
                print("SDK available but ImageGenerationModel not found. Switching to REST.")
        
        except Exception as e:
            print(f"SDK generation failed: {e}")
            print("Switching to REST fallback...")
    
    if not sdk_success:
        generate_image_via_rest(prompt, output_file)

def generate_image_via_rest(prompt, output_file):
    try:
        import requests
    except ImportError:
        print("Error: 'requests' library required for REST fallback.")
        return

    print(f"Requesting image via REST for model: {DEFAULT_MODEL}...")
    url = f"https://generativelanguage.googleapis.com/v1beta/models/{DEFAULT_MODEL}:predict?key={API_KEY}"
    
    headers = {
        'Content-Type': 'application/json'
    }
    
    # Payload for Imagen on Gemini API
    data = {
        "instances": [
            {
                "prompt": prompt
            }
        ],
        "parameters": {
            "sampleCount": 1,
            # "aspectRatio": "1:1" # Optional
        }
    }
    
    try:
        response = requests.post(url, headers=headers, json=data)
        response.raise_for_status()
        result = response.json()
        
        # Check for predictions
        if "predictions" in result and len(result["predictions"]) > 0:
            prediction = result["predictions"][0]
            # Content can be base64 string or complex object depending on version
            b64_data = prediction.get("bytesBase64Encoded")
            
            if b64_data:
                img_data = base64.b64decode(b64_data)
                
                # Create directory if needed (in case called directly)
                out_dir = os.path.dirname(output_file)
                if out_dir and not os.path.exists(out_dir):
                    os.makedirs(out_dir)
                    
                with open(output_file, "wb") as f:
                    f.write(img_data)
                print(f"Image generated (REST)! Saving to {output_file}...")
                print("Done.")
            else:
                print("No bytesBase64Encoded found in prediction.")
                print(f"Prediction keys: {prediction.keys()}")
        else:
            print("No predictions returned in response.")
            print(f"Result keys: {result.keys()}")
            
    except Exception as e:
        print(f"Error calling REST API: {e}")
        if 'response' in locals() and response:
            print(f"Response status: {response.status_code}")
            print(f"Response text: {response.text}")

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description="Generate images using Google Gemini/Imagen API.")
    parser.add_argument("prompt", help="Text description of the image to generate")
    parser.add_argument("--output", default="generated_asset.png", help="Filename for the output image")
    
    args = parser.parse_args()
    
    # Ensure output directory exists (if path provided)
    output_dir = os.path.dirname(args.output)
    if output_dir and not os.path.exists(output_dir):
        os.makedirs(output_dir)
        
    generate_image(args.prompt, args.output)
