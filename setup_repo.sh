#!/bin/bash
# Load .env file
if [ -f .env ]; then
    export $(cat .env | xargs)
fi

# Configurable variables
GITHUB_USER=$CLIENT_ID
GITHUB_TOKEN=$CLIENT_SECRET
REPO_NAME=$GITHUB_USER
REPO_DESCRIPTION=$REPO_DESCRIPTION
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
            "AlleyCat\\\\PhotoImporter\\\\": "src/"
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
