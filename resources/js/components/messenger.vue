<template>
    <div v-if="chat || friend" class="w-100 overflow-hidden position-relative">
        <chatHeader :chat="chat" :friend="friend" /> <!-- chatHeader -->

        <chatContent :chat="chat" :friend="friend" /> <!-- chatContent -->

        <chatFooter :chat="chat" :friend="friend" /> <!-- chatFooter -->
    </div>
</template>

<script>
import chatHeader from "./chatHeader.vue";
import chatContent from "./chatContent.vue";
import chatFooter from "./chatFooter.vue";
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

export default {
    components: {
        chatContent, chatFooter, chatHeader
    },
    props: ['chat', 'friend'],
    data() {
        return {
            messages: [],
            channel: null,
            start_typing: false,
            timeout: null,
            last_message: null,
        }
    },
    methods: {
        startTyping() {
            if (!this.start_typing) {
                this.start_typing = true;
                if (this.$root.chat) {
                    this.channel.whisper('typing', {
                        user_id: this.$root.userId,
                        chat_id: this.$root.chat.id,
                    });
                }
            }
            if (this.timeout) {
                clearTimeout(this.timeout);
            }
            this.timeout = setTimeout(() => {
                this.start_typing = false;
                if (this.$root.chat) {
                    this.channel.whisper('stop-typing', {
                        user_id: this.$root.userId,
                        chat_id: this.$root.chat.id,
                    });
                }
            }, 2000);
        },
    },
    mounted: function () {
        window.Pusher = Pusher;
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '9c8aa83bdd3c106a4b82',
            cluster: 'ap2',
            forceTLS: true
        });

        window.Echo.join(`messenger.${this.$root.userId}`)
            .listen('MessageCreated', (data) => {
                if (this.$root.chat && this.$root.chat.id == data.message.conversation_id) {
                    this.$root.messages.push(data.message);
                    this.$root.chat.new_messages++;
                    this.$root.chat.last_message = data.message;
                } else {
                    let chat = this.$root.findChat(data.message.conversation_id);
                    if (chat) {
                        chat.last_message = data.message;
                        chat.new_messages++;
                    } else {
                        fetch(`api/conversations/${data.message.conversation_id}`)
                            .then(response => response.json())
                            .then(chat => {
                                chat.new_messages = 1;
                                this.$root.chats.push(chat);
                            });
                    }
                }
            })

        this.channel = window.Echo.join(`messenger`)
            .joining((user) => {


                this.$root.findFriend(user.id).isOnline = true;
                for (let i = 0; i < this.$root.chats.length; i++) {
                    for (let x = 0; x < this.$root.chats[i].participants.length; x++) {
                        if (this.$root.chats[i].participants[x].id == user.id) {
                            this.$root.chats[i].participants[x].isOnline = true;
                        }
                    }
                }
            }).leaving((user) => {
                this.$root.findFriend(user.id).isOnline = false;

                for (let i = 0; i < this.$root.chats.length; i++) {
                    for (let x = 0; x < this.$root.chats[i].participants.length; x++) {
                        if (this.$root.chats[i].participants[x].id == user.id) {
                            this.$root.chats[i].participants[x].isOnline = false;
                        }
                    }
                }
            }).listenForWhisper('typing', (e) => {

                let chat = this.$root.findChat(e.chat_id);
                if (chat) {
                    let user = chat.participants.find(participant => participant.id == e.user_id);
                    if (user) {
                        user.isTyping = true;
                    }
                }

            }).listenForWhisper('stop-typing', (e) => {

                let chat = this.$root.findChat(e.chat_id);
                if (chat) {
                    let user = chat.participants.find(participant => participant.id == e.user_id);
                    if (user) {
                        user.isTyping = false;
                    }
                }

            });
    },
}
</script>
