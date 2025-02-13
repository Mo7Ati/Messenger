import moment from 'moment';


let chatList = document.querySelector('#chat-list');
let messageList = document.querySelector('#message-list');
let messageForm = document.querySelector('#message-form') ?? document.createElement('form');
let messageInput = document.querySelector("#message-body");


window.onload = async function () {
    await fetch('api/conversations').then((response) => {
        const chats = response.json();
        return chats;
    }).then((chats) => {
        console.log(chats);
        chats.forEach((chat) => {
            displayChat(chat);
        });
    });

    let chats = chatList.querySelectorAll('li');
    chats.forEach(chat => {
        chat.addEventListener('click', (e) => {
            e.preventDefault();

            let chatId = chat.querySelector('#chat-id').getAttribute('data-id');
            document.querySelector("#conversation-id").value = chatId;

            fetch(`/api/conversations/${chatId}/messages`)
                .then(response => {
                    return response.json();
                }).then(response => {
                    let messages = response['messages'];
                    document.querySelector("#chat-name").textContent = response.participants[0].name;
                    document.querySelector("#chat-avatar").src = response.participants[0].avatar_url;

                    messageList.innerHTML = "";
                    messages.forEach((message) => {
                        displayMessage(message);
                    });;
                });
        })
    });
}

messageForm.addEventListener('submit', (e) => {
    e.preventDefault();
    fetch('/api/messages', {
        method: 'post',
        body: JSON.stringify({
            'message': messageInput.value,
            'conversation_id': messageForm.querySelector("#conversation-id").value,
        }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },

    }).then(async (response) => {
        const message = await response.json();
        displayMessage(message);
    });
    messageInput.value = "";
});


let displayChat = function (chat) {
    let li = document.createElement('li');
    li.className = "chat-item"
    li.innerHTML =
        `<a href="" id="chat-nav">
                <input type="text" id="chat-id" data-id="${chat.id}" hidden>
                <div class="d-flex">
                    <div class="chat-user-img online align-self-center me-3 ms-0">
                        <img src="${chat.participants[0].avatar_url}"
                            class="rounded-circle avatar-xs" alt="">
                        <span class="user-status"></span>
                    </div>

                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-truncate font-size-15 mb-1">
                            ${chat.participants[0].name}
                        </h5>
                        <p class="chat-user-message text-truncate mb-0"
                            id="last-message">
                            ${chat.last_message.body}</p>
                    </div>
                    <div class="font-size-11">
                       ${moment(chat.last_message.created_at).fromNow()}</div>
                </div>
            </a>` ;
    chatList.appendChild(li);
}


let displayMessage = function (msg) {
    const message = document.createElement('li');
    message.className = (msg.user.id === userId) ? '' : 'right';
    message.innerHTML = `
        <div class="conversation-list">
            <div class="chat-avatar">
                <img src="${msg.user.avatar_url}" alt="">
            </div>

            <div class="user-chat-content">
                <div class="ctext-wrap">
                    <div class="ctext-wrap-content">
                        <p class="mb-0">
                            ${msg.body}
                        </p>
                        <p class="chat-time mb-0"><i
                            class="ri-time-line align-middle"></i>
                            <span
                                class="align-middle"> ${moment(msg.created_at).fromNow(true)} </span>
                        </p>
                    </div>
                    <div class="dropdown align-self-start">
                        <a class="dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Copy <i
                                class="ri-file-copy-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Save <i
                                class="ri-save-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Forward <i
                                class="ri-chat-forward-line float-end text-muted"></i></a>
                            <a class="dropdown-item" href="#">Delete <i
                                class="ri-delete-bin-line float-end text-muted"></i></a>
                        </div>
                    </div>
                </div>
                <div class="conversation-name">${msg.user.name}</div>
            </div>
        </div>
        `
    messageList.appendChild(message);
}



window.displayMessage = displayMessage;





