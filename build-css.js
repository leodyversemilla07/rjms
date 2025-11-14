const postcss = require('postcss');
const tailwindcss = require('@tailwindcss/postcss');
const fs = require('fs');
const path = require('path');

const inputFile = path.join(__dirname, 'resources', 'css', 'tailwind.css');
const outputFile = path.join(__dirname, 'public', 'css', 'tailwind.css');

// Read input CSS
const css = fs.readFileSync(inputFile, 'utf8');

// Process with PostCSS and Tailwind
postcss([tailwindcss()])
  .process(css, { from: inputFile, to: outputFile })
  .then(result => {
    // Ensure output directory exists
    const outputDir = path.dirname(outputFile);
    if (!fs.existsSync(outputDir)) {
      fs.mkdirSync(outputDir, { recursive: true });
    }
    
    // Write output file
    fs.writeFileSync(outputFile, result.css);
    
    if (result.map) {
      fs.writeFileSync(outputFile + '.map', result.map.toString());
    }
    
    console.log('✅ CSS built successfully!');
    console.log(`📁 Output: ${outputFile}`);
  })
  .catch(error => {
    console.error('❌ Error building CSS:', error);
    process.exit(1);
  });
