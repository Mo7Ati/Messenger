<template>
    <div class="chat-conversation p-4 p-lg-4" ref="container" data-simplebar>
        <ul class="list-unstyled mb-0" id="message-container">
            <li v-for=" message in $root.messages" class="message"
                :class="{ 'right': ($root.userId != message.user_id) }">
                <div class="conversation-list">
                    <div class="chat-avatar">
                        <img :src="message.user.avatar_url" alt="">
                    </div>
                    <div class="user-chat-content">
                        <div class="ctext-wrap">
                            <div class="ctext-wrap-content">
                                <p class="mb-0">
                                    {{ message.body }}
                                </p>
                                <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i>
                                    <span class="align-middle"> {{ moment(message.created_at).fromNow(true) }} </span>
                                </p>
                            </div>
                            <div class="dropdown align-self-start">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Copy <i
                                            class="ri-file-copy-line float-end text-muted"></i></a>
                                    <a class="dropdown-item" href="#">Save <i
                                            class="ri-save-line float-end text-muted"></i></a>
                                    <a class="dropdown-item" href="#">Forward <i
                                            class="ri-chat-forward-line float-end text-muted"></i></a>
                                    <a class="dropdown-item" @click.prevent="deleteMessage(message)">Delete <i
                                            class="ri-delete-bin-line float-end text-muted"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="conversation-name">{{ message.user.name }}</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: ['chat', 'friend'],
    data() {
        return {
            moment,

        }
    },
    computed: {
        getChat() {
            return this.chat;
        }
    },
    mounted: function () {
        if (this.chat) {
            fetch(`/api/conversations/${this.chat.id}/messages`)
                .then(response => {
                    return response.json();
                }).then(response => {
                    this.$root.messages = response['messages'];
                    // //scroll
                    // let container = document.querySelector("#message-container");
                    // this.$parent.last_message = container.lastElementChild.scrollIntoView(false);
                    // //
                });
        }

    },
    methods: {
        deleteMessage(msg) {
            fetch(`api/messages/${msg.id}`, {
                method: 'delete',
                headers: {
                    'Content-Type': 'application/json',
                    'accept': 'application/json',
                    'X-CSRF-TOKEN': this.$root.csrfToken,
                },
            });
            let msgIndex = this.$root.messages.indexOf(msg);
            this.$root.messages.splice(msgIndex, 1);
        }
    },
    // //scroll
    // updated: function () {
    //     let container = document.querySelector("#message-container");
    //     this.$parent.last_message = container.lastElementChild.scrollIntoView(false);
    // },
    // //
    watch: {
        getChat(newChat) {
            if (newChat) {
                fetch(`/api/conversations/${newChat.id}/messages`)
                    .then(response => {
                        return response.json();
                    }).then(response => {
                        this.$root.messages = response['messages'];
                    });
            }
        },
    },

}
</script>
