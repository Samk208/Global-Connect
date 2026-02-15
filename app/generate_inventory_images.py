import os
import sys

# Setup logging
debug_file = os.path.join(os.path.dirname(os.path.abspath(__file__)), "debug_trace.txt")
def log(msg):
    print(msg)
    try:
        with open(debug_file, "a", encoding="utf-8") as f:
            f.write(str(msg) + "\n")
    except Exception as e:
        print(f"Logging failed: {e}")

# Load local env file first
base_dir = os.path.dirname(os.path.abspath(__file__))
env_path = os.path.join(base_dir, '.env.local')

log(f"Base dir: {base_dir}")
log(f"Env path: {env_path}")

if os.path.exists(env_path):
    log("Loading env file...")
    with open(env_path, 'r') as f:
        for line in f:
            if line.strip() and not line.startswith('#'):
                try:
                    key, value = line.strip().split('=', 1)
                    value = value.strip().strip("'").strip('"')
                    os.environ[key] = value
                except ValueError:
                    pass
else:
    log("Warning: .env.local not found")

# Ensure GEMINI_API_KEY exists
if "GEMINI_API_KEY" not in os.environ:
    if "GOOGLE_API_KEY" in os.environ:
        os.environ["GEMINI_API_KEY"] = os.environ["GOOGLE_API_KEY"]
        log("Copied GOOGLE_API_KEY to GEMINI_API_KEY")
    else:
        log("ERROR: GEMINI_API_KEY not found in environment")

# Add path to nano_banana scripts
sys.path.append(os.path.join(base_dir, '../.agent/skills/nano_banana/scripts'))

try:
    import generate_asset
    log("Imported generate_asset successfully")
except ImportError as e:
    log(f"Failed to import generate_asset: {e}")
    sys.exit(1)

# Define output dir
output_dir = os.path.join(base_dir, 'public/wp-content/uploads/2026/02')

# Create directory safely
try:
    if not os.path.exists(output_dir):
        log(f"Creating output directory: {output_dir}")
        os.makedirs(output_dir)
    else:
        log(f"Output directory exists: {output_dir}")
except Exception as e:
    log(f"Error creating directory: {e}")
    sys.exit(1)

# FORCE API KEY UPDATE in module
generate_asset.API_KEY = os.environ.get("GEMINI_API_KEY")
generate_asset.DEFAULT_MODEL = os.environ.get("GEMINI_IMAGE_MODEL", "imagen-4.0-generate-001")
log(f"Using API Key: {generate_asset.API_KEY[:5]}... (length={len(generate_asset.API_KEY) if generate_asset.API_KEY else 0})")
log(f"Using Model: {generate_asset.DEFAULT_MODEL}")

# Prompts
images = [
    {
        "prompt": "Photorealistic side view of a 2019 Toyota Camry SE, white sedan, white background",
        "filename": "toyota-camry-2019.png"
    },
    {
        "prompt": "Photorealistic angled front view of a 2020 Honda CR-V EX, silver SUV, white background",
        "filename": "honda-crv-2020.png"
    },
    {
        "prompt": "Photorealistic angled front view of a 2018 Ford Explorer XLT, black SUV, white background",
        "filename": "ford-explorer-2018.png"
    },
    {
        "prompt": "Yellow Caterpillar 320D Excavator digging on construction site, photorealistic, high quality",
        "filename": "caterpillar-320d.png"
    },
    {
        "prompt": "2018 Mercedes-Benz Sprinter 2500 cargo van, white, side view, photorealistic, white background",
        "filename": "mercedes-sprinter-2018.png"
    },
    {
        "prompt": "Flat vector icon shipping container port logistics blue and white",
        "filename": "usa-inventory-logistics-icon.png"
    },
    {
        "prompt": "Flat vector icon heavy machinery and tires blue and white",
        "filename": "china-machinery-icon.png"
    },
    {
        "prompt": "Flat vector icon premium car sourcing luxury vehicle blue and white",
        "filename": "europe-sourcing-icon.png"
    }
]

for img in images:
    output_path = os.path.join(output_dir, img["filename"])
    log(f"Processing {img['filename']} -> {output_path}")
    
    try:
        generate_asset.generate_image(img["prompt"], output_path)
        if os.path.exists(output_path):
            size = os.path.getsize(output_path)
            log(f"SUCCESS: Generated {output_path} ({size} bytes)")
        else:
            log(f"FAILURE: {output_path} not found after generation call")
    except Exception as e:
        log(f"EXCEPTION generating {img['filename']}: {e}")
        import traceback
        log(traceback.format_exc())

log("Finished script.")
