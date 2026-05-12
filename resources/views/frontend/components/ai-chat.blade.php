<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- ================= AI CHAT ================= -->

<style>

    /* ================= AI PRODUCT ================= */

.ai-product-card{
    display:flex;
    gap:12px;

    background:#fff;

    border-radius:18px;

    padding:12px;

    margin-top:15px;

    box-shadow:0 5px 15px rgba(0,0,0,.06);

    align-items:center;
}

.ai-product-image{
    width:90px;
    height:90px;

    object-fit:cover;

    border-radius:14px;

    flex-shrink:0;

    background:#f5f5f5;
}

.ai-product-info{
    flex:1;
}

.ai-product-info h6{
    font-size:14px;
    font-weight:700;

    margin-bottom:6px;

    color:#444;
}

.ai-price{
    font-size:14px;
    font-weight:600;

    color:#ff5f8f;

    margin-bottom:10px;
}

.ai-buy-btn{
    border:none;

    background:linear-gradient(135deg,#ff8fb1,#ff5f8f);

    color:white;

    border-radius:50px;

    padding:8px 16px;

    font-size:13px;
    font-weight:600;

    transition:.3s;
}

.ai-buy-btn:hover{
    transform:scale(1.05);
}

*{
    box-sizing:border-box;
}

/* ================= FLOAT BUTTON ================= */

#aiBubble{
    position:fixed;
    bottom:25px;
    right:25px;

    width:68px;
    height:68px;

    border-radius:50%;
    background:linear-gradient(135deg,#ff8fb1,#ff5f8f);

    display:flex;
    justify-content:center;
    align-items:center;

    color:white;
    font-size:28px;

    cursor:pointer;

    z-index:99999;

    box-shadow:0 12px 30px rgba(255,105,135,.35);

    transition:.3s;
}

#aiBubble:hover{
    transform:scale(1.08);
}

/* ================= CHAT BOX ================= */

#chatBox{
    position:fixed;

    right:25px;
    bottom:105px;

    width:420px;
    height:650px;

    background:white;

    border-radius:30px;

    z-index:99999;

    overflow:hidden;

    display:none;

    flex-direction:column;

    box-shadow:0 20px 45px rgba(0,0,0,.18);

    animation:fadeUp .3s ease;
}

/* OPEN STATE */
#chatBox.active{
    display:flex;
}

@keyframes fadeUp{

    from{
        opacity:0;
        transform:translateY(20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

/* ================= HEADER ================= */

#chatHeader{
    height:85px;

    background:linear-gradient(135deg,#ff8fb1,#ff5f8f);

    color:white;

    padding:18px;

    display:flex;
    align-items:center;
    justify-content:space-between;

    flex-shrink:0;
}

.header-left{
    display:flex;
    align-items:center;
    gap:12px;
}

.ai-avatar{
    width:45px;
    height:45px;

    border-radius:50%;

    object-fit:cover;

    border:2px solid rgba(255,255,255,.4);
}

.header-title{
    margin:0;
    font-size:15px;
    font-weight:700;
}

.header-status{
    font-size:12px;
    opacity:.9;
}

#closeChat{
    font-size:20px;
    cursor:pointer;
}

/* ================= CONTENT ================= */

#chatContent{
    flex:1;

    overflow-y:auto;
    overflow-x:hidden;

    padding:20px;

    background:#fff7fa;
}

.msg-wrapper{
    display:flex;
    flex-direction:column;

    margin-bottom:15px;
}

.user-wrapper{
    align-items:flex-end;
}

.ai-wrapper{
    align-items:flex-start;
}

/* USER */

.user-msg{
    background:linear-gradient(135deg,#ff8fb1,#ff5f8f);

    color:white;

    padding:12px 15px;

    border-radius:18px 18px 5px 18px;

    font-size:14px;
    line-height:1.5;

    max-width:80%;

    word-break:break-word;
}

/* AI */

.ai-msg{
    background:white;

    color:#444;

    padding:12px 15px;

    border-radius:18px 18px 18px 5px;

    font-size:14px;
    line-height:1.7;

    max-width:80%;

    box-shadow:0 5px 12px rgba(0,0,0,.05);

    word-break:break-word;
}

/* TIME */

.chat-time{
    margin-top:4px;

    font-size:11px;

    color:#999;
}

/* ================= INPUT AREA ================= */

#chatInputArea{
    background:white;

    border-top:1px solid #f0f0f0;

    padding:12px;

    display:flex;
    align-items:center;
    gap:10px;

    flex-shrink:0;
}

/* INPUT */

#userInput{
    flex:1;

    height:50px;

    border:none;
    outline:none;

    background:#f4f4f4;

    border-radius:50px;

    padding:0 18px;

    font-size:14px;

    min-width:0;
}

#userInput::placeholder{
    color:#999;
}

/* SEND BUTTON */

#sendBtn{
    width:50px;
    height:50px;

    min-width:50px;

    border:none;

    border-radius:50%;

    background:linear-gradient(135deg,#ff8fb1,#ff5f8f);

    color:white;

    font-size:18px;

    display:flex;
    justify-content:center;
    align-items:center;

    cursor:pointer;

    transition:.3s;
}

#sendBtn:hover{
    transform:scale(1.05);
}

/* ================= TYPING ================= */

.typing{
    display:flex;
    align-items:center;
    gap:5px;
}

.typing span{
    width:8px;
    height:8px;

    background:#ff8fb1;

    border-radius:50%;

    animation:bounce 1s infinite;
}

.typing span:nth-child(2){
    animation-delay:.2s;
}

.typing span:nth-child(3){
    animation-delay:.4s;
}

@keyframes bounce{

    0%,100%{
        transform:translateY(0);
        opacity:.5;
    }

    50%{
        transform:translateY(-5px);
        opacity:1;
    }

}

/* ================= SCROLL ================= */

#chatContent::-webkit-scrollbar{
    width:6px;
}

#chatContent::-webkit-scrollbar-thumb{
    background:#ffc1d1;
    border-radius:20px;
}

/* ================= MOBILE ================= */

@media(max-width:768px){

    #chatBox{
        width:95%;
        height:82vh;

        right:2.5%;
        bottom:90px;

        border-radius:25px;
    }

    #chatContent{
        padding:15px;
    }

    .user-msg,
    .ai-msg{
        max-width:90%;
        font-size:13px;
    }

    #chatInputArea{
        padding:10px;
    }

    #userInput{
        height:48px;
        font-size:14px;
    }

    #sendBtn{
        width:48px;
        height:48px;
        min-width:48px;
    }

    #aiBubble{
        width:62px;
        height:62px;

        right:18px;
        bottom:18px;

        font-size:24px;
    }

}

</style>

<!-- FLOATING BUTTON -->

<div id="aiBubble">
    <i class="bi bi-stars"></i>
</div>

<!-- CHAT BOX -->

<div id="chatBox">

    <!-- HEADER -->

    <div id="chatHeader">

        <div class="header-left">

            <img 
                src="https://i.pinimg.com/1200x/99/d9/82/99d982a89531e41e3d1e31761c025fd8.jpg"
                class="ai-avatar"
            >

            <div>
                <h6 class="header-title">
                    Beauty AI Assistant
                </h6>

                <div class="header-status">
                    Online sekarang
                </div>
            </div>

        </div>

        <div id="closeChat">
            <i class="bi bi-x-lg"></i>
        </div>

    </div>

    <!-- CONTENT -->

    <div id="chatContent">

        <div class="msg-wrapper ai-wrapper">

            <div class="ai-msg">
                Hai cantik 💖 <br>
                Aku siap bantu rekomendasi skincare, makeup, dan konsultasi kulit kamu ✨
            </div>

            <div class="chat-time">
                just now
            </div>

        </div>

    </div>

    <!-- INPUT -->

    <div id="chatInputArea">

        <input 
            type="text"
            id="userInput"
            placeholder="Tanya skincare..."
        >

        <button id="sendBtn">
            <i class="bi bi-send-fill"></i>
        </button>

    </div>

</div>

<script>

const bubble = document.getElementById('aiBubble');
const chatBox = document.getElementById('chatBox');
const closeChat = document.getElementById('closeChat');
const sendBtn = document.getElementById('sendBtn');
const userInput = document.getElementById('userInput');
const chatContent = document.getElementById('chatContent');

// OPEN CHAT
bubble.addEventListener('click', () => {
    chatBox.classList.toggle('active');
});

// CLOSE CHAT
closeChat.addEventListener('click', () => {
    chatBox.classList.remove('active');
});

// ENTER SEND
userInput.addEventListener('keypress', function(e){
    if(e.key === 'Enter'){
        sendMessage();
    }
});

// GET TIME
function getTime(){
    const now = new Date();
    return now.getHours().toString().padStart(2,'0')
        + ':' +
        now.getMinutes().toString().padStart(2,'0');
}

// SEND MESSAGE
async function sendMessage(){

    let message = userInput.value.trim();
    if(message === '') return;

    // USER MESSAGE
    chatContent.innerHTML += `
        <div class="msg-wrapper user-wrapper">
            <div class="user-msg">${message}</div>
            <div class="chat-time">${getTime()}</div>
        </div>
    `;

    userInput.value = '';

    // LOADING
    chatContent.innerHTML += `
        <div class="msg-wrapper ai-wrapper" id="typingBox">
            <div class="ai-msg">
                <div class="typing">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    `;

    chatContent.scrollTop = chatContent.scrollHeight;

    try{

        let response = await fetch('/api/chat-ai', {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        });

        let data = await response.json();

        // REMOVE TYPING
        let typing = document.getElementById('typingBox');
        if(typing) typing.remove();

        // ================= PRODUCT =================
        let productHTML = '';

        if(data.products && data.products.length > 0){

            data.products.forEach(product => {

                console.log(product);

                let price = parseInt(product.harga_satuan || product.price) || 0;

                let image = 'https://via.placeholder.com/90?text=No+Image';
                    let productImage =
                        product.image ||
                        product.gambar ||
                        product.foto ||
                        '';

                    if(productImage && typeof productImage === 'string'){

                        if(productImage.startsWith('http')){

                            image = productImage;

                        }else{

                            image = '/storage/' + productImage;
                        }
                    }


                productHTML += `
                    <div class="ai-product-card">

                        <img 
                            src="${image}" 
                            class="ai-product-image"
                            onerror="this.src='https://via.placeholder.com/90?text=No+Image'"
                        >

                        <div class="ai-product-info">
                            <h6>${product.nama_produk || product.name || 'Produk'}</h6>
                            <p class="ai-price">
                                Rp ${price.toLocaleString('id-ID')}
                            </p>

                            <button 
                                class="ai-buy-btn"
                                data-id="${product.id_produk || product.id || ''}"
                                data-name="${product.nama_produk || product.name || ''}"
                                data-price="${price}"
                                data-image="${image}"
                            >
                                + Keranjang
                            </button>

                        </div>

                    </div>
                `;
            });
        }

        // ================= AI RESPONSE =================
        chatContent.innerHTML += `
            <div class="msg-wrapper ai-wrapper">
                <div class="ai-msg">
                    ${data.reply || 'Tidak ada respon'}
                    ${productHTML}
                </div>
                <div class="chat-time">${getTime()}</div>
            </div>
        `;

        chatContent.scrollTop = chatContent.scrollHeight;

    }catch(error){

        let typing = document.getElementById('typingBox');
        if(typing) typing.remove();

        chatContent.innerHTML += `
            <div class="msg-wrapper ai-wrapper">
                <div class="ai-msg">
                    Maaf 😭 terjadi kesalahan server
                </div>
            </div>
        `;
    }
}

// CLICK SEND
document.addEventListener('click', function(e){

    if(e.target.classList.contains('ai-buy-btn')){

        fetch('/cart/add', {
            method:'POST',
            credentials:'same-origin',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: e.target.dataset.id,
                name: e.target.dataset.name,
                price: parseInt(e.target.dataset.price),
                image: e.target.dataset.image
            })
        })
        .then(res => res.json())
        .then(() => {

            alert('Produk ditambahkan ke keranjang');

            // UPDATE ANGKA CART
            const cartCount = document.getElementById('cart-count');

            if(cartCount){

                let current = parseInt(cartCount.innerText) || 0;

                cartCount.innerText = current + 1;
            }

            // KALAU FUNCTION loadCart ADA
            if(typeof loadCart === 'function'){
                loadCart();
            }

        });

    }

});


</script>
<!-- ================= END AI CHAT ================= -->