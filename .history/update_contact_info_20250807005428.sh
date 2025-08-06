#!/bin/bash

# Script untuk mengubah informasi kontak BDARU menjadi static di semua halaman
# Informasi yang akan diubah:
# - Alamat: Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia
# - Email: balaiadatrajopenghulu@gmail.com
# - Telepon: 0823-7355-5447
# - Instagram: @bdaru.official

echo "Mengubah informasi kontak BDARU menjadi static..."

# Array file Vue yang perlu diubah
files=(
    "resources/js/Pages/Welcome.vue"
    "resources/js/Pages/About.vue"
    "resources/js/Pages/Contact.vue"
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
        echo "Memproses: $file"

        # Backup file
        cp "$file" "$file.backup"

        # Mengubah alamat
        sed -i '' 's/{{ props\.museumSettings?\.address || '\''Belum tersedia'\'' }}/Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.address || '\''Jl\. Museum Nasional No\. 1'\'' }}/Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia/g' "$file"

        # Mengubah kota dan kode pos
        sed -i '' 's/{{ props\.museumSettings?\.city || '\''Belum tersedia'\'' }}, {{ props\.museumSettings?\.postal_code || '\'''\'' }}/Kota Bengkulu, Bengkulu/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.city || '\''Jakarta Pusat'\'' }}, {{ props\.museumSettings?\.postal_code || '\''10110'\'' }}/Kota Bengkulu, Bengkulu/g' "$file"

        # Mengubah email
        sed -i '' 's/{{ props\.museumSettings?\.email_info || '\''Belum tersedia'\'' }}/balaiadatrajopenghulu@gmail.com/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.email_info || '\''info@bdaru-museum\.id'\'' }}/balaiadatrajopenghulu@gmail.com/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.email_support || '\''Belum tersedia'\'' }}/balaiadatrajopenghulu@gmail.com/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.email_support || '\''support@bdaru-museum\.id'\'' }}/balaiadatrajopenghulu@gmail.com/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.email_partnership || '\''partnership@bdaru-museum\.id'\'' }}/balaiadatrajopenghulu@gmail.com/g' "$file"

        # Mengubah telepon
        sed -i '' 's/{{ props\.museumSettings?\.phone_1 || '\''Belum tersedia'\'' }}/0823-7355-5447/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.phone_1 || '\''+62213868172'\'' }}/0823-7355-5447/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.phone_1 || '\''+62 21 386 8172'\'' }}/0823-7355-5447/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.phone_2 || '\''Belum tersedia'\'' }}/0823-7355-5447/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.phone_2 || '\''+62213868173'\'' }}/0823-7355-5447/g' "$file"
        sed -i '' 's/{{ props\.museumSettings?\.phone_2 || '\''+62 21 386 8173'\'' }}/0823-7355-5447/g' "$file"

        # Mengubah country
        sed -i '' 's/{{ props\.museumSettings?\.country || '\''Indonesia'\'' }}/Indonesia/g' "$file"

        echo "✅ Selesai: $file"
    else
        echo "❌ File tidak ditemukan: $file"
    fi
done

echo ""
echo "🎉 Selesai mengubah informasi kontak BDARU menjadi static!"
echo "📝 Informasi yang diubah:"
echo "   - Alamat: Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia"
echo "   - Email: balaiadatrajopenghulu@gmail.com"
echo "   - Telepon: 0823-7355-5447"
echo "   - Instagram: @bdaru.official"
echo ""
echo "💡 Catatan: File backup telah dibuat dengan ekstensi .backup"
