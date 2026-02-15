
import os
import sys
from dotenv import load_dotenv
from google import genai
from google.genai import types

# Load .env.local
load_dotenv('.env.local')
api_key = os.getenv('GEMINI_API_KEY')

if not api_key:
    print("Error: GEMINI_API_KEY not found.")
    sys.exit(1)

print(f"Using API Key: {api_key[:5]}...")

def test_generation(model_name):
    print(f"\nTesting model: {model_name}")
    try:
        client = genai.Client(api_key=api_key)
        response = client.models.generate_images(
            model=model_name,
            prompt='An oil painting of a fuzzy panda',
            config=types.GenerateImagesConfig(
                number_of_images=1,
            )
        )
        if response.generated_images:
            for i, img in enumerate(response.generated_images):
                output_file = f"test_genai_{model_name.replace('/', '_')}_{i}.jpg"
                img.image.save(output_file)
                print(f"Success! Saved to {output_file}")
        else:
            print("No images returned.")
            
    except Exception as e:
        print(f"Error testing {model_name}: {e}")

# Try known imagen models
models_to_test = [
    'imagen-3.0-generate-001',
    'imagen-4.0-generate-001', # Just in case
]

for m in models_to_test:
    test_generation(m)
