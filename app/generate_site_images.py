
import os
import sys
import time
from dotenv import load_dotenv
from google import genai
from google.genai import types

# Load environment variables
load_dotenv('.env.local')

# Configuration
API_KEY = os.getenv("GEMINI_API_KEY")
MODEL_NAME = "imagen-4.0-generate-001"
OUTPUT_DIR = "c:\\Users\\Lenovo\\Local Sites\\globalconnect\\app\\public\\wp-content\\themes\\globalconnect-child\\assets\\images\\generated"

if not API_KEY:
    print("Error: GEMINI_API_KEY not found in environment variables.")
    sys.exit(1)

# Configure Gemini Client
client = genai.Client(api_key=API_KEY)

# Image Definitions
images_to_generate = [
    {
        "filename": "inventory-usa-header.jpg",
        "prompt": "Cinematic view of a modern US port with American flags shipping containers and diverse vehicles under golden hour lighting photorealistic high resolution",
        "aspect_ratio": "16:9"
    },
    {
        "filename": "inventory-europe-header.jpg",
        "prompt": "Sophisticated European logistics hub Antwerp port with luxury cars and Euro trucks waiting for export clean modern style cool blue tones photorealistic",
        "aspect_ratio": "16:9"
    },
    {
        "filename": "inventory-china-header.jpg",
        "prompt": "Futuristic industrial shipping hub in China with heavy machinery Sinotruk trucks and tire containers warm red and gold lighting high tech photorealistic",
        "aspect_ratio": "16:9"
    },
    {
        "filename": "placeholder-vehicle.jpg",
        "prompt": "Modern white sedan studio lighting clean background photorealistic automotive photography",
        "aspect_ratio": "4:3" # Standard photo
    },
    {
        "filename": "placeholder-truck.jpg",
        "prompt": "Heavy duty construction truck clean studio background photorealistic",
        "aspect_ratio": "4:3"
    },
    {
        "filename": "placeholder-part.jpg",
        "prompt": "Automotive engine parts artistic arrangement clean studio lighting photorealistic",
        "aspect_ratio": "1:1" # Square for parts
    }
]

def generate_image(prompt, output_path, aspect_ratio="1:1"):
    print(f"Generating: {output_path}...")
    print(f"Prompt: {prompt}")
    
    try:
        response = client.models.generate_images(
            model=MODEL_NAME,
            prompt=prompt,
            config=types.GenerateImagesConfig(
                number_of_images=1,
                aspect_ratio=aspect_ratio,
                safety_filter_level="block_only_high",
                person_generation="allow_adult", 
            )
        )
        
        if response.generated_images:
            image = response.generated_images[0].image
            image.save(output_path)
            print(f"Saved to {output_path}")
            return True
        else:
            print("No images returned.")
            return False
            
    except Exception as e:
        print(f"Error generating image: {e}")
        # import traceback
        # traceback.print_exc()
        return False

# Ensure output directory exists
if not os.path.exists(OUTPUT_DIR):
    os.makedirs(OUTPUT_DIR)
    print(f"Created output directory: {OUTPUT_DIR}")

# Main Loop
success_count = 0
for img_def in images_to_generate:
    output_path = os.path.join(OUTPUT_DIR, img_def["filename"])
    
    # Optional: Skip if exists (comment out if you want to regenerate)
    if os.path.exists(output_path):
         print(f"Skipping {img_def['filename']} - already exists.")
         success_count += 1
         continue
        
    # For placeholders, I set generic aspect ratios in the list, defaulting to 1:1 if not found (though all have it now)
    ar = img_def.get("aspect_ratio", "1:1")
    
    if generate_image(img_def["prompt"], output_path, aspect_ratio=ar):
        success_count += 1
    
    # Sleep briefly to avoid rate limits
    time.sleep(2)

print(f"\nFinished. Generated {success_count}/{len(images_to_generate)} images.")
