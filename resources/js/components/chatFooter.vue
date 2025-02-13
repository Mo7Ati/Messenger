<template>
    <div class="chat-input-section p-3 p-lg-4 border-top mb-0">
        <form method="POST" id="message-form" action="" @submit.prevent="sendMessage()">
            <input type="text" value="" id="conversation-id" hidden>
            <div class="row g-0">
                <div class="col">
                    <input type="text" class="form-control form-control-lg bg-light border-light"
                        placeholder="Enter Message..." v-model="message" name="body" @keypress="$parent.startTyping()"
                        @focus.prevent="$root.chatRead()">
                </div>
                <div class="col-auto">
                    <div class="chat-input-links ms-md-2 me-md-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Emoji">
                                <button type="button"
                                    class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                    <i class="ri-emotion-happy-line"></i>
                                </button>
                            </li>
                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Attached File">
                                <button type="button"
                                    class="btn btn-link text-decoration-none font-size-16 btn-lg waves-effect">
                                    <i class="ri-attachment-line"></i>
                                </button>
                            </li>
                            <li class="list-inline-item">
                                <button type="submit" id="send-button"
                                    class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                    <i class="ri-send-plane-2-fill"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['chat', 'friend'],
    data() {
        return {
            message: '',
        }
    },
    methods: {
        sendMessage() {
            if (this.chat) {
                fetch('/api/messages', {
                    method: 'post',
                    body: JSON.stringify({
                        'message': this.message,
                        'conversation_id': this.chat.id,
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.$root.csrfToken,
                    },
                }).then(response => {
                    return response.json();
                }).then(response => {
                    this.$root.messages.push(response.message);
                    this.$root.chat.last_message = response.message;
                });
                this.message = '';
            }
            if (this.friend) {
                fetch('/api/messages', {
                    method: 'post',
                    body: JSON.stringify({
                        'message': this.message,
                        'user_id': this.friend.id,
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.$root.csrfToken,
                    },
                }).then(response => {
                    return response.json();
                }).then(response => {
                    this.$root.chat = response.chat;
                    this.$root.chats.push(response.chat);
                    this.$root.messages.push(response.message);
                    this.$root.chat.last_message = response.message;
                });
                this.message = '';

            }

        },

    }
}
</script>
