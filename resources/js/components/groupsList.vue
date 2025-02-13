<template>
    <div>
        <div class="p-4">
            <div class="user-chat-nav float-end">
                <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create group">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-link text-decoration-none text-muted font-size-18 py-0"
                        data-bs-toggle="modal" data-bs-target="#addgroup-exampleModal">
                        <i class="ri-group-line me-1 ms-0"></i>
                    </button>
                </div>

            </div>
            <h4 class="mb-4">Groups</h4>

            <!-- Start add group Modal -->
            <div class="modal fade" id="addgroup-exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="addgroup-exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-size-16" id="addgroup-exampleModalLabel">
                                Create New Group</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body p-4">
                            <form>
                                <div class="mb-4">
                                    <label for="addgroupname-input" class="form-label">Group
                                        Name</label>
                                    <input type="text" class="form-control" id="addgroupname-input"
                                        placeholder="Enter Group Name" v-model="name">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Group Members</label>
                                    <div class="mb-3">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#groupmembercollapse" aria-expanded="false"
                                            aria-controls="groupmembercollapse">
                                            Select Members
                                        </button>
                                    </div>

                                    <div class="collapse" id="groupmembercollapse">
                                        <div class="card border">
                                            <div class="card-header">
                                                <h5 class="font-size-15 mb-0">Contacts</h5>
                                            </div>

                                            <div class="card-body p-2">
                                                <div data-simplebar style="max-height: 150px;">
                                                    <div>
                                                        <ul class="list-unstyled contact-list">
                                                            <li v-for="friend in $root.friends">
                                                                <div class="p-3 fw-bold text-primary"
                                                                    v-if="$root.letterCheck(friend.name[0])">
                                                                    {{ friend.name[0] }}
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        v-bind:value="friend.id" id="memberCheck1"
                                                                        v-model="users">
                                                                    <label class="form-check-label"
                                                                        for="memberCheck1">{{ friend.name }}</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="addgroupdescription-input" class="form-label">Description</label>
                                    <textarea class="form-control" id="addgroupdescription-input" rows="3"
                                        placeholder="Enter Description"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click.prevent="createGroup()">Create
                                Groups</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End add group Modal -->

            <div class="search-box chat-search-box">
                <div class="input-group rounded-3">
                    <span class="input-group-text text-muted bg-light pe-1 ps-3" id="basic-addon1">
                        <i class="ri-search-line search-icon font-size-18"></i>
                    </span>
                    <input type="text" class="form-control bg-light" placeholder="Search groups..."
                        aria-label="Search groups..." aria-describedby="basic-addon1">
                </div>
            </div> <!-- Search Box-->
        </div>

        <!-- Start chat-group-list -->
        <div class="p-4 chat-message-list chat-group-list" data-simplebar>
            <ul class="list-unstyled chat-list">
                <li v-for="chat in $root.chats">
                    <a href="" @click.prevent="setChat(chat)" v-if="chat.type == 'group'">
                        <div class="d-flex align-items-center">
                            <div class="chat-user-img me-3 ms-0">
                                <div class="avatar-xs">
                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        {{ chat.label[0] }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate font-size-14 mb-0">{{ chat.label }}</h5>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End chat-group-list -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: null,
            users: [],
        }
    },
    methods: {
        createGroup() {
            fetch('api/groups', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json',
                    'accept': 'application/json',
                    'X-CSRF-TOKEN': this.$root.csrfToken,
                },
                body: JSON.stringify({
                    users: this.users,
                    label: this.name,
                })
            }).then(response => response.json())
                .then((response) => {
                    this.$root.chats.push(response.group);
                });
        },
        setChat(group) {
            this.$root.chat = group;
        }
    }
}

</script>
