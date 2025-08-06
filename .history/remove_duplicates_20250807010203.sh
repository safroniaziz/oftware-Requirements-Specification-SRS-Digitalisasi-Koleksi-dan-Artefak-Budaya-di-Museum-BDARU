#!/bin/bash

# Script untuk menghapus email dan telepon ganda di semua halaman
echo "Menghapus email dan telepon ganda di semua halaman..."

# Array file Vue yang perlu diperbaiki
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
        echo "Memperbaiki duplikasi: $file"

        # Backup file
        cp "$file" "$file.backup4"

        # Menghapus email ganda di footer
        # Pattern: dua baris email berturut-turut
        sed -i '' '/<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/,/<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/ {
            /<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/ {
                N
                /<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>\n.*<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/ {
                    s/<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>\n.*<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/<p class="text-gray-300 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/
                }
            }
        }' "$file"

        # Menghapus telepon ganda di footer
        # Pattern: dua baris telepon berturut-turut
        sed -i '' '/<p class="text-gray-300 text-sm">0823-7355-5447<\/p>/,/<p class="text-gray-300 text-sm">0823-7355-5447<\/p>/ {
            /<p class="text-gray-300 text-sm">0823-7355-5447<\/p>/ {
                N
                /<p class="text-gray-300 text-sm">0823-7355-5447<\/p>\n.*<p class="text-gray-300 text-sm">0823-7355-5447<\/p>/ {
                    s/<p class="text-gray-300 text-sm">0823-7355-5447<\/p>\n.*<p class="text-gray-300 text-sm">0823-7355-5447<\/p>/<p class="text-gray-300 text-sm">0823-7355-5447<\/p>/
                }
            }
        }' "$file"

        # Menghapus email ganda dengan pattern lain
        sed -i '' '/<p class="text-gray-600 mb-3">balaiadatrajopenghulu@gmail.com<\/p>/,/<p class="text-gray-600 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/ {
            /<p class="text-gray-600 mb-3">balaiadatrajopenghulu@gmail.com<\/p>/ {
                N
                /<p class="text-gray-600 mb-3">balaiadatrajopenghulu@gmail.com<\/p>\n.*<p class="text-gray-600 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/ {
                    s/<p class="text-gray-600 mb-3">balaiadatrajopenghulu@gmail.com<\/p>\n.*<p class="text-gray-600 text-sm">balaiadatrajopenghulu@gmail.com<\/p>/<p class="text-gray-600 mb-3">balaiadatrajopenghulu@gmail.com<\/p>/
                }
            }
        }' "$file"

        # Menghapus telepon ganda dengan pattern lain
        sed -i '' '/<p class="text-gray-600 mb-3">0823-7355-5447<\/p>/,/<p class="text-gray-600 text-sm">0823-7355-5447<\/p>/ {
            /<p class="text-gray-600 mb-3">0823-7355-5447<\/p>/ {
                N
                /<p class="text-gray-600 mb-3">0823-7355-5447<\/p>\n.*<p class="text-gray-600 text-sm">0823-7355-5447<\/p>/ {
                    s/<p class="text-gray-600 mb-3">0823-7355-5447<\/p>\n.*<p class="text-gray-600 text-sm">0823-7355-5447<\/p>/<p class="text-gray-600 mb-3">0823-7355-5447<\/p>/
                }
            }
        }' "$file"

        echo "✅ Selesai memperbaiki duplikasi: $file"
    else
        echo "❌ File tidak ditemukan: $file"
    fi
done

echo ""
echo "🎉 Selesai menghapus duplikasi email dan telepon!"
echo "📝 Perbaikan yang dilakukan:"
echo "   - Menghapus email ganda di footer"
echo "   - Menghapus telepon ganda di footer"
echo "   - Menghapus email ganda di bagian kontak"
echo "   - Menghapus telepon ganda di bagian kontak"
