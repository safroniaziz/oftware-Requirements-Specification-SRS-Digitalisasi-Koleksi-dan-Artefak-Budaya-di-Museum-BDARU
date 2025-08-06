#!/bin/bash

# Update all Vue files to use static BDARU logo
echo "Updating Vue files with BDARU logo..."

# List of Vue files to update
files=(
    "resources/js/Pages/Collections.vue"
    "resources/js/Pages/CollectionDetail.vue"
    "resources/js/Pages/News.vue"
    "resources/js/Pages/NewsDetail.vue"
    "resources/js/Pages/Events.vue"
    "resources/js/Pages/EventDetail.vue"
    "resources/js/Pages/Contact.vue"
    "resources/js/Pages/Testimonials.vue"
)

for file in "${files[@]}"; do
    if [ -f "$file" ]; then
        echo "Updating $file..."

        # Replace dynamic logo with static BDARU logo
        sed -i '' 's/:src="props\.museumSettings\.logo_url"/src="\/assets\/src\/images\/bdaru.jpeg"/g' "$file"
        sed -i '' 's/:alt="props\.museumSettings?\.museum_name || '\''Logo Museum'\''"/alt="BDARU Museum"/g' "$file"
        sed -i '' 's/v-if="props\.museumSettings?\.logo_url" //g' "$file"
        sed -i '' 's/<!-- Dynamic Logo from Database -->/<!-- Static BDARU Logo -->/g' "$file"

        # Remove v-else blocks for default icons
        sed -i '' '/<!-- Default Icon if no logo -->/,/<!-- Enhanced Floating Particles -->/d' "$file"

        echo "✓ Updated $file"
    else
        echo "⚠ File not found: $file"
    fi
done

echo "Logo update completed!"
