import { createApp } from "vue";
import chatList from "./components/chatList.vue";
import messenger from "./components/messenger.vue";
import FriendsList from "./components/friendsList.vue";
import GroupList from "./components/groupsList.vue";

const app = createApp({
    data() {
        return {
            chats: [],
            friends: [],
            chat: null,
            friend: null,
            messages: [],
            userId: userId,
            csrfToken: csrf_token,
        };
    },
    methods: {
        findChat(id) {
            let chat = this.chats.find(chat => chat.id == id);
            return chat ? chat : null;
        },
        findFriend(id) {
            let friend = this.friends.find(friend => friend.id == id);
            return friend ? friend : null;
        },
        findChatParticipant(id) {

        },
        chatRead() {
            if (this.chat && this.chat.new_messages != 0) {
                fetch(`api/messages/${this.$root.chat.id}/read`, {
                    method: "post",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrfToken,
                    },
                });
                this.chat.new_messages = 0;
            }
        },
        letterCheck(lett) {
            if (this.letter && this.letter === lett) {
                return false;
            }
            this.letter = lett;
            return true;
        }
    },
});

app.component('messenger', messenger);
app.component('chat-list', chatList);
app.component('friendsList', FriendsList)
app.component('groupsList', GroupList);

app.mount("#chat-app");
