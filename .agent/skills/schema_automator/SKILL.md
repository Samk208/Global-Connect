---
name: Schema.org Automator
description: Generates custom JSON-LD schema markup for WordPress pages, optimized for RankMath.
---

# Schema.org Automator

RankMath Pro allows pasting custom JSON-LD schema. This skill automates the generation of compliant schema based on your page content.

## Capabilities

- **Context-Aware Generation**: Analyses content text to determine the best Schema type (e.g., `Product`, `FAQPage`, `HowTo`).
- **RankMath Format**: Ready to copy-paste into RankMath's Schema Generator "Import" tab.

## Usage

### 1. Generate Schema from Content

Provide the content of your page (e.g., from a text file or draft):

```bash
python .agent/skills/schema_automator/scripts/generate_schema.py "path/to/content.txt" --type "Product"
```

### 2. Supported Types

- `Product` (for e-commerce/listings)
- `FAQPage` (for support pages)
- `HowTo` (for tutorials)
- `LocalBusiness` (for contact pages)

### Installation in Other Projects

Copy the `.agent/skills/schema_automator` folder to your other project's `.agent/skills/` directory.
