#!/bin/bash

# Script untuk memperbaiki informasi kontak BDARU yang belum terubah dengan benar
echo "Memperbaiki informasi kontak BDARU..."

# Array file Vue yang perlu diperbaiki
files=(
    "resources/js/Pages/Contact.vue"
)

for file in "${files[@]}"; do
    if [ -f "$file" ]; then
        echo "Memperbaiki: $file"

        # Backup file
        cp "$file" "$file.backup2"

        # Mengubah telepon yang masih salah
        sed -i '' 's/+62 21 386 8172/0823-7355-5447/g' "$file"
        sed -i '' 's/+62 21 386 8173/0823-7355-5447/g' "$file"

        # Menambahkan Instagram di bagian kontak
        # Cari bagian telepon dan tambahkan Instagram setelahnya
        sed -i '' '/<div class="flex items-start space-x-3">/,/<\/div>/ {
            /0823-7355-5447/ {
                a\
                        </div>\
                        </div>\
                        <div class="flex items-start space-x-3">\
                            <svg class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">\
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>\
                            </svg>\
                            <div>\
                                <p class="text-gray-300 text-sm">@bdaru.official</p>\
                            </div>
            }
        }' "$file"

        echo "✅ Selesai memperbaiki: $file"
    else
        echo "❌ File tidak ditemukan: $file"
    fi
done

echo ""
echo "🎉 Selesai memperbaiki informasi kontak BDARU!"
echo "📝 Informasi yang diperbaiki:"
echo "   - Telepon: 0823-7355-5447"
echo "   - Instagram: @bdaru.official"
