#!/usr/bin/env bash
#
# build-release.sh — bangun artefak rilis `tema-natra` (ZIP).
#
# Bentuk artefak = git-archive ber-wrapper `OpenSID-tema-natra-<sha>/...`,
# dibaca App\Services\Theme\ThemeCatalogSyncService (Layanan#1341) yang
# mensyaratkan wrapper tunggal berisi `theme.json` di dalamnya -- padanan
# build-release.sh modul (mis. modul-anjungan), tanpa langkah enkripsi
# IonCube: tema adalah Blade+CSS+JS presentasional, tak ada logika PHP
# proprietary yang perlu disembunyikan seperti kode modul.
set -euo pipefail

NAME="Natra"
OUT="${1:-./dist}"
SHA="$(git rev-parse --short HEAD)"
WRAP="OpenSID-tema-natra-${SHA}"
STAGE="$(mktemp -d)"
trap 'rm -rf "$STAGE"' EXIT

mkdir -p "$OUT"
OUT="$(cd "$OUT" && pwd)"   # absolutkan agar aman lintas-cd

# Ekspor pohon terlacak ke wrapper dir (hormati .gitattributes export-ignore).
git archive --format=tar --prefix="${WRAP}/" HEAD | tar -xf - -C "$STAGE"

ZIP="$OUT/${NAME}.zip"
rm -f "$ZIP"
( cd "$STAGE" && zip -rq "$ZIP" "$WRAP" )

echo "artefak : $ZIP"
echo "sha     : $SHA"
