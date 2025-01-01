#!/bin/bash
CLIENT_ID=Iv23likhf4Br9YsMxCGx
CLIENT_SECRET=20dafd3c2ca38b37ecfd347959150ed2d1f26b24
APP_ID=1100210
# Private Key (Use multi-line handling in your code for private keys)
PRIVATE_HASH="SHA256:9ypNyvYY7UDIHvkrgulvOoQx3imd5/sqH2tZNV75zZM="
PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAtGjrhEhAuJa1zdLS+iBIatAXLJV4oJf6ajn8mfDOIugcbFUj
0IrUN4SnX7wgAwN3WQ+/B9fUSfadIiLEwJ3qj2xa1QoKRB3Z14+OxLMo2mBRg2D6
LZxj90gcugyhs7Jx3Uc4aNnEOdqkQhtwcaBkcPQGjjbBo1XzziHn8jJqpF/Bb7cp
5RFvA8muSa+A+iP8bH/3Unhqu6a9eYwxeBjO8Fd8yVrpEWzhPqxOWv9TgS1GbFBu
SGatNWrJ+79pXNjKa/sRwQ+d7IPPQMuPbXM7s5qbUqkyO6SRGJmMHh3Gv3IoVnRK
U1MbviACgrGTueQSp6Js+VnEDaFnRgomv7dKFQIDAQABAoIBADDDUzVUGjpKciWJ
4IC/DRPh3wGr/QjbS1I/DinFztHcjyIw+Rc7DxVag6r6vGRUIYQvH2FNUxIS2HIL
l8bAaFAP55VBu3ih4OnE4cAE9PvhoOaz5atCZDrIgQtAssxRZTl8MKEWi1Vf5ZoA
tKnhwoRNUSBLaJdvehCzVXA/dFetHV1aD/7n1m0svyNH4V8xdVEexTCTIbFACL7b
dR/3JQQQtp61+Cj9glkyPdkW8bKa0ZV9pEHKuOhL1SLM/6pNFg5gr5hS2VTu8zQf
wXpTXx5WiQCY/TWnXaT6HP6hUtl16Z/QhmmguwyVJy5jZPOgQR89MS86s84sSbZ8
sEVrjZkCgYEA7lV/qfGsbb2dq0ULKYyJDte36mWpix2eNm/1q97ELwhOgN8yNmf3
zyXBtyGzLOG1XOhzj1MI/+LV6UUn2JyJ0/8Hc46gwl0s+UHk9MQASQw2F3o4/p+z
sat5JP+YDzEQmKbTrhnd5vY58tyxSSRC3H1c2LQDUEHSVJsfsHlL+Z8CgYEAwchI
ecfAnEUdS5hL1DgBeJIXlsa1WQHe4JjcUxVpBDavmpqxt7wxEeKC1xxTE42RzqFT
qzM8DUwJ41z9GO02w9oUzL8LB38mKP3YraaEeLahQE9gieCblo4b87mWBrZJPNK2
3OE6LNA4Uw74lWbCaT7J87RqjemUDaCQAus7B8sCgYB9k5kPjyH+NJF144wtGTpC
EtF59JTvkuyA3F8Cbv7JlUPfzTpkxkUg5VD7UAtbU5W+3U++Lc8pHHj/TwveqyRI
CjD/5x+3KWb/8oNToE5SLtf1aNXM+5Kvw5yyLOYO4xhOhmA0dLah8gy4dSYIVs3P
5VHdcIPqbrQHFjENR+wLGwKBgAJjncEinVVP5NSRxB2RszLxWikZuhKm20CZod3E
Xc8XfYLCdX52a4R07ngIeV28WRfbFVT/BLaFQXn0I4qzIgG4Jpl/oXsuLiJDPvCl
JOz4E3Tfhaktg72PcvjGSPs8NBrz3h1LCZST3J3piVcONUdm5saCau3k+1ZPrHbc
v5WRAoGAFchX/zDxf5GsddanIC7HLXRMr0V+NKKvvcCyi/LY5utSu9yYjz9P4IsO
RVupQNTlew4HBCv2D23n1B8UArjJS9H9ccdTAw9ebYXaNyMy9kavJAot7s/GEakB
dNefxGFcFB0WbSKHzfVou8a8h+0Zojd6MtRFfqmQRUrEgBrLvDM=
-----END RSA PRIVATE KEY-----"

# Configurable variables
GITHUB_USER="alleycatphoto"
GITHUB_TOKEN="YSHA256:9ypNyvYY7UDIHvkrgulvOoQx3imd5/sqH2tZNV75zZM="
REPO_NAME="alleycat-photoimporter"
REPO_DESCRIPTION="AlleyCat PhotoImporter 3.0.7 - Magical photo importing, now with more frosting!"
REMOTE_URL="https://github.com/$GITHUB_USER/$REPO_NAME.git"

# Setup files
echo "Creating setup files..."

# Create README.md
cat <<EOL > README.md
# AlleyCat PhotoImporter 3.0.7

AlleyCat PhotoImporter is a sophisticated, geeky tool for photographers that simplifies importing, categorizing, and preparing photos. Featuring Big Lebowski quotes and humor, this tool is tailored for professional workflows.

## Features
- Automated photo importing from SD cards or folders
- Intelligent photo categorization based on folder structure
- Resizing, rotating, and EXIF metadata updates
- Progress monitoring via JSON updates
- Shopify integration for seamless order creation

## Setup

1. Clone the repository:
   \`\`\`bash
   git clone $REMOTE_URL
   \`\`\`

2. Install dependencies:
   \`\`\`bash
   composer install
   \`\`\`

3. Run tests:
   \`\`\`bash
   composer test
   \`\`\`

4. Start importing with:
   \`\`\`bash
   php import.php
   \`\`\`

## License
This software is © 2024 Alley Cat Photo, created by Paul K. Smith. "The Dude abides."
EOL

# Create .gitignore
cat <<EOL > .gitignore
# Logs
logs/*.log

# Thumbnails
thumbnails/

# Cache
.cache/

# Temporary files
*.tmp
*.swp
*.bak

# Node modules (if using JavaScript frontend)
node_modules/
EOL

# Create composer.json
cat <<EOL > composer.json
{
    "name": "alleycatphoto/photoimporter",
    "description": "$REPO_DESCRIPTION",
    "require": {
        "php": "^7.4|^8.0",
        "monolog/monolog": "^2.0"
    },
    "autoload": {
        "psr-4": {
            "AlleyCat\\PhotoImporter\\": "src/"
        }
    },
    "scripts": {
        "test": "phpunit tests/"
    }
}
EOL

# Create example test
mkdir -p tests
cat <<EOL > tests/PhotoImporterTest.php
<?php
use PHPUnit\Framework\TestCase;

class PhotoImporterTest extends TestCase
{
    public function testExample()
    {
        \$this->assertTrue(true, "The Dude abides.");
    }
}
EOL

# Initialize Git repository
echo "Initializing Git repository..."
git init
git add .
git commit -m "Initial commit: Added setup files and basic structure."

# Set up remote repository and push
echo "Setting up remote repository..."
git remote add origin "$REMOTE_URL"

# Push to GitHub
echo "Pushing to GitHub..."
git push -u origin main

# Print success message
echo "Repository successfully set up at $REMOTE_URL"
