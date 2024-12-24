 // A textarea és a karakterek számolása
 const textarea = document.getElementById('umessage');
 const charCount = document.getElementById('charCount');
 const maxChars = 1000;

 // Event listener, ami figyeli a beírt karakterek számát
 textarea.addEventListener('input', function() {
     const remainingChars = maxChars - textarea.value.length;
     charCount.textContent = `Még ${remainingChars} karakter használható.`;
 });