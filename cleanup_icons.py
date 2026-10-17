from pathlib import Path
import re

root = Path(r'.\resources\views')
patterns = [
    r'(?is)<span\s+class="[^"]*(?:value-icon|d-icon)[^"]*"[^>]*>.*?</span>',
    r'(?is)<span\s+style="[^"]*(?:font-size:\s*(?:15px|14px)|flex-shrink:0)[^"]*">.*?</span>',
    r'(?is)<button\s+class="close-(?:modal|cart)"\s+onclick="[^"]*">\s*.*?\s*</button>',
    r'(?is)\.value-icon\s*\{[^}]*\}',
    r'(?is)\.delivery-btn\s+\.d-icon\s*\{[^}]*\}',
    r'(?is)(?:\u00e2|\u00f0|\u00c3|\u00ef|\u0153|\u2022|\u20ac|\u2014|\u2013|\u2122|\u00d7|\u00a0|\u00b8|\u00a9|\u00ae)+',
    r'(?is)/\*\s*.*?\*/',
    r'(?is)<!--\s*.*?-->',
]

for path in root.rglob('*.blade.php'):
    text = path.read_text(encoding='utf-8', errors='surrogateescape')
    for pattern in patterns:
        text = re.sub(pattern, '', text)

    text = text.replace('  ', ' ')
    path.write_text(text, encoding='utf-8')

print('cleaned blade files')
