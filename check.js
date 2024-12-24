document.querySelector('form').addEventListener('submit', function(event) {
    // Üzenet tárolása
    let errors = [];
    
    // Mezők ellenőrzése
    const uname = document.getElementById('uname');
    const umail = document.getElementById('umail');
    const umessage = document.getElementById('umessage');
    
    // Ha a "Név" mező üres
    if (uname.value.trim() === '') {
        errors.push('A név mező kitöltése kötelező.');
    }
    
    // Ha az "E-mail" mező üres vagy nem megfelelő formátumú
    if (umail.value.trim() === '' || !/\S+@\S+\.\S+/.test(umail.value)) {
        errors.push('Kérem, adjon meg egy érvényes e-mail címet.');
    }
    
    // Ha az "Üzenet" mező üres
    if (umessage.value.trim() === '') {
        errors.push('Az üzenet mező kitöltése kötelező.');
    }

    // Ha hibák vannak, megjelenítjük őket és megakadályozzuk a beküldést
    if (errors.length > 0) {
        event.preventDefault();  // Megakadályozza az űrlap elküldését
        alert(errors.join('\n')); // Hibaüzenetek megjelenítése
    }
});