#!/bin/bash
# Script to change meta image background from white to black
# Requires ImageMagick (install with: brew install imagemagick)

# Change white/transparent background to black
convert public/images/carbon_meta.png \
    -background black \
    -alpha remove \
    -alpha off \
    -fuzz 10% \
    -fill black \
    -opaque white \
    public/images/carbon_meta.png

echo "Meta image background changed to black!"

