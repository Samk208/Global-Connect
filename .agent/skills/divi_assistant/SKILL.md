---
name: Divi Assistant
description: A set of tools to analyze and optimize Divi layouts, including mobile responsiveness and CSS cleaning.
---

# Divi Assistant

This skill enhances your workflow when working with the Divi Builder. It includes tools to help diagnose visual issues and extract custom CSS from JSON exports.

## Capabilities

- **Mobile Visual Matcher**: Analyzes screenshots of your Divi layout on mobile to identify responsiveness issues.
- **CSS Cleaner**: Takes a Divi library export (`.json`) and extracts all `custom_css` fields into a separate file.

## Usage

### 1. Mobile Responsiveness Check (Conceptual)

1. Use `.agent/skills/nano_banana/scripts/generate_asset.py` (or manually capture a screenshot) of your mobile view.
2. Provide the image to your AI agent and ask:
   "Analyze this screenshot for Divi layout issues. Is the 'Text Module' overlapping the 'Image Module'?"
   *Tip: Use the Vision capabilities of your AI model.*

### 2. Extract Custom CSS from Divi JSON

Run the script on your Divi export file:

```bash
python .agent/skills/divi_assistant/scripts/extract_css.py path/to/divi-export.json
```

This will create a `custom_css.css` in the same directory, containing all inline CSS found in the modules.

### Installation in Other Projects

Copy the `.agent/skills/divi_assistant` folder to your other project's `.agent/skills/` directory.
