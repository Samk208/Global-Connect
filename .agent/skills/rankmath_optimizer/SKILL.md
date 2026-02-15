---
name: RankMath SEO Optimizer
description: Use this skill to optimize SEO meta data for WordPress posts using RankMath-specific meta keys via WP-CLI.
---

# RankMath SEO Optimizer

This skill helps automate the tedious process of SEO optimization for WordPress sites using RankMath Pro. It analyzes content and generates the precise WP-CLI commands needed to update post metadata.

## Capabilities

- **Keyword Analysis**: Suggests focus keywords based on content semantic relevance.
- **Meta Generation**: Drafts high-CTR titles and descriptions within character limits.
- **Automation**: Outputs ready-to-use `wp post meta update` commands.

## Usage

### 1. Analyze a Text File and Generate Commands

```bash
python .agent/skills/rankmath_optimizer/scripts/generate_seo_meta.py "path/to/content.txt" --post_id 123
```

### 2. Manual Analysis

The agent can also manually review content and suggest commands:
1. **Identify Topic**: Read the content.
2. **Propose Focus Keyword**: `rank_math_focus_keyword`
3. **Draft Title**: `rank_math_title` (Max 60 chars)
4. **Draft Description**: `rank_math_description` (Max 160 chars)
5. **Output Command**:
   ```bash
   wp post meta update [ID] rank_math_focus_keyword "Your Keyword"
   wp post meta update [ID] rank_math_title "Your Optimized Title"
   wp post meta update [ID] rank_math_description "Your compelling description..."
   ```

## Installation in Other Projects

Copy the `.agent/skills/rankmath_optimizer` folder to your other project's `.agent/skills/` directory.
