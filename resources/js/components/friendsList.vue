<template>
    <div>

        <ul class="list-unstyled contact-list">
            <li v-for="friend in $root.friends">
                <div class="p-3 fw-bold text-primary" v-if="$root.letterCheck(friend.name[0])">
                    {{ friend.name[0] }}
                </div>
                <a href="" id="chat-nav" @click.prevent="startChat(friend)">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center flex-grow-1 row-cols">
                            <div class="chat-user-img me-3 ms-0">
                                <div class="avatar-xs"><span
                                        class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        {{ friend.name[0] }}</span>
                                    <span class="user-status " v-if="friend.isOnline"></span>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate font-size-14 mb-0">{{ friend.name }}</h5>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="text-muted dropdown-toggle" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Share <i
                                        class="ri-share-line float-end text-muted"></i></a>
                                <a class="dropdown-item" href="#">Block <i
                                        class="ri-forbid-line float-end text-muted"></i></a>
                                <a class="dropdown-item" href="#">Remove <i
                                        class="ri-delete-bin-line float-end text-muted"></i></a>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>

</template>
<script>
export default {
    data() {
        return {
            letter: null,
        }
    },
    methods: {
        startChat(friend) {
            let chat = this.$root.chats.find(chat => chat.type == 'peer' && chat.participants[0].id == friend.id);
            if (chat) {
                this.$root.chat = chat;
            } else {
                this.$root.chat = null;
                this.$root.friend = friend;
                this.$root.messages = [];
            }
        },
    },
}
</script>
