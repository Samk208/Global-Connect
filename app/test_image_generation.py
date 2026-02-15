import google.generativeai as genai
import os
from dotenv import load_dotenv

load_dotenv('.env.local')
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

def test_model(model_name, prompt):
    print(f"Testing model: {model_name}")
    try:
        model = genai.GenerativeModel(model_name)
        response = model.generate_content(prompt)
        # print(f"Response: {response}") # Don't print full response
        if response.parts:
            print(f"Number of parts: {len(response.parts)}")
            for i, part in enumerate(response.parts):
                print(f"Part {i}: {type(part)}")
                # Check for image
                # In google-generativeai, image might be in part.text (if it's base64?) or part.inline_data or part.image
                # But actually, verify structure.
                try:
                    if hasattr(part, 'image'):
                         part.image.save(f"test_output_{model_name.replace('/', '_')}.jpg")
                         print(f"Saved image to test_output_{model_name.replace('/', '_')}.jpg")
                    elif hasattr(part, 'inline_data'):
                         import base64
                         img_data = base64.b64decode(part.inline_data.data)
                         with open(f"test_output_{model_name.replace('/', '_')}.jpg", "wb") as f:
                             f.write(img_data)
                         print(f"Saved inline_data image to test_output_{model_name.replace('/', '_')}.jpg")
                except Exception as e:
                     print(f"Failed to save image part: {e}")
        else:
             print("No parts in response. Check safety ratings?")
             print(response.prompt_feedback)
    except Exception as e:
        print(f"Error testing {model_name}: {e}")

# Test likely candidates
test_model("models/gemini-2.5-flash-image", "Generate an image of a cute robot")
test_model("models/gemini-3-pro-image-preview", "Generate an image of a cute robot")
# Also try standard gemini-2.5-flash just in case
test_model("models/gemini-2.5-flash", "Generate an image of a cute robot")
