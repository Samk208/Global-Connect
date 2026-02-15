import google.generativeai as genai
import os
from dotenv import load_dotenv

load_dotenv('.env.local')
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

with open("genai_error_log.txt", "w") as f:
    f.write(f"Version: {genai.__version__}\n")
    try:
        f.write("Listing available models:\n")
        for m in genai.list_models():
            f.write(f"Model: {m.name}\n")
            f.write(f"Supported methods: {m.supported_generation_methods}\n")
    except Exception as e:
        f.write(f"Failed to list models: {e}\n")

