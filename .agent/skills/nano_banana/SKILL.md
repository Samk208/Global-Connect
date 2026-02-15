---
name: Nano Banana (Imagen/Gemini) Asset Generator
description: A skill for generating and editing visual assets using Google's generative AI models (Imagen 3 / Gemini Pro Vision) via the Gemini API.
---

# Nano Banana (Gemini/Imagen) Asset Generator

This skill leverages your existing Google Gemini API key to generate images. It uses the `google-generativeai` library to create assets directly from text prompts.

## Capabilities

- **Generate Images**: Create high-quality images using Google's Imagen 3 model (via Gemini API).
- **Save Assets**: Automatically save generated images to a specified directory (default: `./public/generated`).

## Configuration

Set the following environment variable in your `.env` file (you likely already have `GEMINI_API_KEY`):

```env
GEMINI_API_KEY=your_gemini_api_key_here
# Optional: Set a specific model if needed, defaults to 'imagen-3.0-generate-001'
GEMINI_IMAGE_MODEL=imagen-3.0-generate-001
```

## Usage

### 1. Generate an Image

Run the script with a text prompt:

```bash
python .agent/skills/nano_banana/scripts/generate_asset.py "A futuristic dashboard with neon blue accents"
```

### 2. Specify Output Filename

```bash
python .agent/skills/nano_banana/scripts/generate_asset.py "A futuristic dashboard" --output dashboard_mockup.png
```

### Installation in Other Projects

Copy the `.agent/skills/nano_banana` folder to your other project's `.agent/skills/` directory. Ensure you install the dependency:

```bash
pip install google-generativeai
```
