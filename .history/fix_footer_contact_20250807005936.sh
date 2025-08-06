#!/bin/bash

# Script untuk memperbaiki informasi kontak di footer semua halaman
echo "Memperbaiki informasi kontak di footer semua halaman..."

# Array file Vue yang perlu diperbaiki
files=(
    "resources/js/Pages/Welcome.vue"
    "resources/js/Pages/About.vue"
    "resources/js/Pages/Collections.vue"
    "resources/js/Pages/CollectionDetail.vue"
    "resources/js/Pages/News.vue"
    "resources/js/Pages/NewsDetail.vue"
    "resources/js/Pages/Events.vue"
    "resources/js/Pages/EventDetail.vue"
    "resources/js/Pages/Testimonials.vue"
)

for file in "${files[@]}"; do
    if [ -f "$file" ]; then
        echo "Memperbaiki footer: $file"

        # Backup file
        cp "$file" "$file.backup3"

        # Mengubah telepon yang masih salah di footer
        sed -i '' 's/+62 21 386 8172/0823-7355-5447/g' "$file"
        sed -i '' 's/+62 21 386 8173/0823-7355-5447/g' "$file"

        # Menghapus email ganda (hanya menyisakan satu)
        sed -i '' '/balaiadatrajopenghulu@gmail.com/,/balaiadatrajopenghulu@gmail.com/ {
            /balaiadatrajopenghulu@gmail.com/ {
                N
                /balaiadatrajopenghulu@gmail.com\n.*balaiadatrajopenghulu@gmail.com/ {
                    s/balaiadatrajopenghulu@gmail.com\n.*balaiadatrajopenghulu@gmail.com/balaiadatrajopenghulu@gmail.com/
                }
            }
        }' "$file"

        # Menghapus baris telepon kedua yang duplikat
        sed -i '' '/0823-7355-5447/,/0823-7355-5447/ {
            /0823-7355-5447/ {
                N
                /0823-7355-5447\n.*0823-7355-5447/ {
                    s/0823-7355-5447\n.*0823-7355-5447/0823-7355-5447/
                }
            }
        }' "$file"

        echo "✅ Selesai memperbaiki footer: $file"
    else
        echo "❌ File tidak ditemukan: $file"
    fi
done

echo ""
echo "🎉 Selesai memperbaiki footer di semua halaman!"
echo "📝 Perbaikan yang dilakukan:"
echo "   - Menghapus email ganda"
echo "   - Mengubah telepon menjadi 0823-7355-5447"
echo "   - Menghapus telepon duplikat"
