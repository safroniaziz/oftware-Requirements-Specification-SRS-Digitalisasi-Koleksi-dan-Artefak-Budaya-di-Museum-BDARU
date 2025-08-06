#!/bin/bash

# Script untuk memperbaiki informasi kontak lama yang masih tersisa
echo "Memperbaiki informasi kontak lama yang masih tersisa..."

# Array file Vue yang perlu diperbaiki
files=(
    "resources/js/Pages/Contact.vue"
    "resources/js/Pages/NewsDetail.vue"
)

for file in "${files[@]}"; do
    if [ -f "$file" ]; then
        echo "Memperbaiki informasi lama: $file"

        # Backup file
        cp "$file" "$file.backup5"

        # Mengubah alamat lama
        sed -i '' 's/Jl\. Museum Nasional No\. 1/Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia/g' "$file"

        # Mengubah kota dan kode pos lama
        sed -i '' 's/Jakarta Pusat, 10110/Kota Bengkulu, Bengkulu/g' "$file"

        # Mengubah email lama
        sed -i '' 's/info@bdaru-museum\.id/balaiadatrajopenghulu@gmail.com/g' "$file"
        sed -i '' 's/support@bdaru-museum\.id/balaiadatrajopenghulu@gmail.com/g' "$file"

        # Mengubah telepon lama (jika masih ada)
        sed -i '' 's/+62 21 386 8172/0823-7355-5447/g' "$file"
        sed -i '' 's/+62 21 386 8173/0823-7355-5447/g' "$file"

        echo "✅ Selesai memperbaiki informasi lama: $file"
    else
        echo "❌ File tidak ditemukan: $file"
    fi
done

echo ""
echo "🎉 Selesai memperbaiki informasi kontak lama!"
echo "📝 Perbaikan yang dilakukan:"
echo "   - Mengubah alamat dari 'Jl. Museum Nasional No. 1'"
echo "   - Mengubah kota dari 'Jakarta Pusat, 10110'"
echo "   - Mengubah email dari 'info@bdaru-museum.id' dan 'support@bdaru-museum.id'"
echo "   - Mengubah telepon dari '+62 21 386 8172/8173'"
