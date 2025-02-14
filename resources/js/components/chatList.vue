<template>
    <div>
        <h5 class="mb-3 px-3 font-size-16">Recent</h5>
        <div class="chat-message-list px-2" data-simplebar>
            <ul class="list-unstyled chat-list chat-user-list" id="chat-list">
                <li v-for="chat in $root.chats" :key="chat.id"  :class="{active : ( $root.chat && chat.id === $root.chat.id ) }" v-endif>
                    <div v-if="chat.type == 'peer'">
                        <a @click.prevent="setMain(chat)" href="#" id="chat-nav">
                            <div class="d-flex">
                                <div class="chat-user-img online align-self-center me-3 ms-0">
                                    <img v-bind:src="chat.participants[0].avatar_url" class="rounded-circle avatar-xs"
                                        alt="">
                                    <span class="user-status" v-if="
                                        moment.utc().diff(moment.utc(chat.participants[0].last_active_at), 'minutes') <= 5 ||
                                        chat.participants[0].isOnline">
                                    </span>
                                </div>

                                <div class=" flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15 mb-1">
                                        {{ chat.participants[0].name }}
                                    </h5>
                                    <p class="chat-user-message text-truncate mb-0" id="last-message"
                                        v-if="!chat.participants[0].isTyping">
                                        {{ chat.last_message.body }}
                                    </p>
                                    <p class="chat-user-message text-truncate mb-0" v-else>typing
                                        <span class="animate-typing">
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="font-size-11">
                                    {{ moment.utc(chat.last_message.created_at).fromNow() }}
                                </div><br>
                                <div class="unread-message" v-if="chat.new_messages">
                                    <span class="badge badge-soft-danger rounded-pill">{{ chat.new_messages
                                        }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div v-if="chat.type == 'group'">
                        <a href="#" id="chat-nav" @click.prevent="setMain(chat)">
                            <div class="d-flex">
                                <div class="chat-user-img online align-self-center me-3 ms-0">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                            {{ chat.label[0] }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    <!-- <label class="text-truncate font-size-15 mb-1" v-for="participant in chat.participants">
                                        {{ participant.name }} ,
                                    </label> -->
                                    <h5 class="text-truncate font-size-15 mb-1">
                                        {{ chat.label }}
                                    </h5>
                                    <p class="chat-user-message text-truncate mb-0" id="last-message">
                                        {{ chat.last_message.body }}</p>
                                </div>
                                <div class="font-size-11">
                                    {{ moment.utc(chat.last_message.created_at).fromNow() }}
                                </div><br>
                                <div class="unread-message" v-if="chat.new_messages">
                                    <span class="badge badge-soft-danger rounded-pill">{{ chat.new_messages }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>

import moment from 'moment';

export default {
    methods: {
        setMain(chat) {
            this.$root.chat = chat;
            this.$root.chatRead();
        },
    },
    data() {
        return {
            moment,
        }
    },
    mounted: function () {
        fetch('api/conversations')
            .then(response => response.json())
            .then((response) => {
                response.chats.forEach(chat => {
                    chat.participants[0].isOnline = false;
                    chat.participants[0].isTyping = false;
                });
                this.$root.chats = response.chats;
                this.$root.friends = response.friends;
                this.$root.groups = response.groups;
            });

    },

    // updated: function () {
    //     fetch('api/conversations')
    //         .then(response => response.json())
    //         .then((response) => {
    //             response.chats.forEach(chat => {
    //                 chat.participants[0].isOnline = false;
    //                 chat.participants[0].isTyping = false;
    //             });
    //             this.$root.chats = response.chats;
    //             this.$root.friends = response.friends;
    //         });
    // }
}
</script>
