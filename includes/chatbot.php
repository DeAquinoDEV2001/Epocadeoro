<div id="chatbot">
    <div id="chatbox">
        <p><strong>Chatbot:</strong> ¡Hola! ¿En qué puedo ayudarte?</p>
    </div>
    <input type="text" id="userInput" placeholder="Escribe aquí..." onkeypress="handleKeyPress(event)">
    <button onclick="sendMessage()">Enviar</button>
</div>

<style>
    #chatbot { 
        color: #333;
        position: fixed; 
        bottom: 20px; 
        right: 20px; 
        width: 250px; 
        background: #f9f9f9; 
        padding: 15px; 
        border-radius: 10px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.47); 
        font-family: Arial, sans-serif;
    }
    #chatbox { 
        height: 200px; 
        overflow-y: auto; 
        border: 1px solid #ddd; 
        padding: 10px; 
        margin-bottom: 10px; 
        background: #fff;
        border-radius: 5px;
    }
    input { 
        width: calc(100% - 80px); 
        padding: 10px; 
        border: 1px solid #ddd; 
        border-radius: 5px; 
        margin-right: 10px;
    }
    button { 
        padding: 10px 15px; 
        background: #007bff; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
        transition: background 0.3s;
        margin-left: 10px;
    }
    button:hover { 
        background: #0056b3; 
    }
</style>

<script>
const predefinedResponses = {
    "hola": "¡Hola! ¿Cómo puedo ayudarte hoy?",
    "reservar": "Para hacer una reservación, por favor visita la sección de Reservaciones.",
    "restaurante": "Puedes consultar los restaurantes disponibles en la sección de Restaurantes.",
    "gracias": "¡De nada! Si tienes alguna otra pregunta, no dudes en preguntar.",
    "adios": "¡Adiós! Que tengas un buen día.",
    "menu": "Puedes ver los menús de los restaurantes en la sección de Restaurantes.",
    "ubicacion": "Puedes encontrar nuestra ubicación en la sección de Restaurantes.",
    "horario": "Los horarios de los restaurantes están disponibles en la sección de Restaurantes.",
    "cancelar reservacion": "Esa opcion no está disponible por el momento.",
    "modificar reservacion": "Esa opcion no está disponible por el momento.",
    "contacto": "Puedes encontrar la información de contacto en la sección de Acerca de.",
    "perfil": "Esa opcion no está disponible por el momento.",
    "ayuda": "Para obtener ayuda, por favor visita la sección de Ayuda.",
    "promociones": "Esa opcion no está disponible por el momento.",
    "eventos": "Esa opcion no está disponible por el momento.",
    "factura": "Esa opcion no está disponible por el momento.",
    "pago": "Esa opcion no está disponible por el momento.",
    "alergias": "Por favor informa al personal sobre cualquier alergia alimentaria.",
    "reservacion grupal": "Para reservaciones grupales, por favor contacta al administrador.",
    "reclamos": "Para realizar un reclamo, por favor visita la sección Acerca de.",
    "sugerencias": "Tus sugerencias son bienvenidas en la sección de Comentarios.",
    "bebidas": "Consulta nuestra carta de bebidas en la sección de Menú.",
    "postres": "Tenemos una amplia variedad de postres disponibles.",
    "brunch": "Ofrecemos brunch los fines de semana de 10:00 a 14:00.",
    "desayuno": "El desayuno está disponible de 7:00 a 11:00.",
    "almuerzo": "El almuerzo se sirve de 12:00 a 15:00.",
    "cena": "La cena está disponible de 18:00 a 22:00.",
    "reservacion online": "Puedes hacer una reservación online desde nuestra página web.",
    "confirmar reservacion": "Recibirás un correo electrónico para confirmar tu reservación.",
    "cancelacion politica": "Consulta nuestra política de cancelación en la sección de Reservaciones.",
    "codigo promocional": "Puedes aplicar un código promocional al realizar tu reservación.",
    "zona infantil": "Contamos con una zona infantil para los más pequeños.",
    "musica en vivo": "Ofrecemos música en vivo los viernes y sábados por la noche.",
    "privacidad": "Consulta nuestra política de privacidad en la sección de Términos y Condiciones.",
    "seguridad": "La seguridad de nuestros clientes es nuestra prioridad.",
    "idiomas": "Nuestro personal habla español e inglés.",
    "tarifas": "Consulta nuestras tarifas en la sección de Precios.",
    "reservacion urgente": "Para reservaciones urgentes, por favor llama directamente al restaurante.",
    "opiniones": "Puedes leer opiniones de otros clientes en la sección de Opiniones.",
    "galeria": "Consulta nuestra galería de fotos en la sección de Galería.",
    "noticias": "Mantente informado con nuestras últimas noticias en la sección de Noticias.",
    "blog": "Lee artículos interesantes en nuestro blog.",
    "suscripcion": "Suscríbete a nuestro boletín para recibir ofertas exclusivas.",
    "zona vip": "Ofrecemos una zona VIP para nuestros clientes especiales.",
    "tarjeta fidelidad": "Obtén puntos con nuestra tarjeta de fidelidad en cada compra.",
    "clima": "Consulta el clima actual en nuestra ubicación en la sección de Información."
};

function sendMessage() {
    let input = document.getElementById("userInput").value.toLowerCase();
    let chatbox = document.getElementById("chatbox");

    if (input.trim() === "") return;
    
    chatbox.innerHTML += `<p><strong>Tú:</strong> ${input}</p>`;

    let response = predefinedResponses[input] || "Lo siento, no entiendo tu pregunta.";
    
    chatbox.innerHTML += `<p><strong>Chatbot:</strong> ${response}</p>`;
    document.getElementById("userInput").value = "";
    chatbox.scrollTop = chatbox.scrollHeight;
}

function handleKeyPress(event) {
    if (event.key === "Enter") sendMessage();
}
</script>
