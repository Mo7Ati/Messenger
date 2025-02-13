<template>
    <div class="p-3 p-lg-4 border-bottom user-chat-topbar">
        <div class="row align-items-center">
            <div class="col-sm-4 col-8" v-if="chat && chat.type == 'peer'">
                <div class="d-flex align-items-center">
                    <div class="d-block d-lg-none me-2 ms-0">
                        <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i
                                class="ri-arrow-left-s-line"></i></a>
                    </div>
                    <div class="chat-user-img online align-self-center me-3 ms-0"><img
                            v-bind:src="chat.participants[0].avatar_url" class="rounded-circle avatar-xs" alt=""><span
                            class="user-status" v-if="chat.participants[0].isOnline"></span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show">
                            </a>
                            <p id="chat-name">
                                {{ chat.participants[0].name }}
                            </p>
                            <small class="text-muted" v-if="chat.participants[0].isTyping">typing ...</small>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-8" v-if="chat && chat.type == 'group'">
                <div class="d-flex align-items-center">
                    <div class="d-block d-lg-none me-2 ms-0">
                        <a href="" class="user-chat-remove text-muted font-size-16 p-2"><i
                                class="ri-arrow-left-s-line"></i></a>
                    </div>
                    <div class="chat-user-img online align-self-center me-3 ms-0">
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                {{ chat.label[0] }}
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show">
                            </a>
                            <p id="chat-name">
                                {{ chat.label }}
                            </p>
                            <div v-for="participant in chat.participants">
                                <p class="text-muted" v-if="participant.isTyping">
                                    {{ participant.name.split(' ')[0] }} typing...
                                </p>
                            </div>

                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-8" v-if="!chat && friend">
                <div class="d-flex align-items-center">
                    <div class="d-block d-lg-none me-2 ms-0">
                        <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i
                                class="ri-arrow-left-s-line"></i></a>
                    </div>
                    <div class="chat-user-img online align-self-center me-3 ms-0"><img v-bind:src="friend.avatar_url"
                            class="rounded-circle avatar-xs" alt=""><span class="user-status"
                            v-if="friend.isOnline"></span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show">
                            </a>
                            <p id="chat-name">
                                {{ friend.name }}
                            </p>
                            <small class="text-muted" v-if="friend.isTyping">typing ...</small>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 col-4">
                <ul class="list-inline user-chat-nav text-end mb-0">
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </button>
                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-md">
                                <div class="search-box p-2">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Search..">
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-inline-item d-none d-lg-inline-block me-2 ms-0">
                        <button type="button" class="btn nav-btn" data-bs-toggle="modal"
                            data-bs-target="#audiocallModal">
                            <i class="ri-phone-line"></i>
                        </button>
                    </li>

                    <li class="list-inline-item d-none d-lg-inline-block me-2 ms-0">
                        <button type="button" class="btn nav-btn" data-bs-toggle="modal"
                            data-bs-target="#videocallModal">
                            <i class="ri-vidicon-line"></i>
                        </button>
                    </li>

                    <li class="list-inline-item d-none d-lg-inline-block me-2 ms-0">
                        <button type="button" class="btn nav-btn user-profile-show">
                            <i class="ri-user-2-line"></i>
                        </button>
                    </li>

                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ri-more-fill"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item d-block d-lg-none user-profile-show" href="#">View profile
                                    <i class="ri-user-2-line float-end text-muted"></i></a>
                                <a class="dropdown-item d-block d-lg-none" href="#" data-bs-toggle="modal"
                                    data-bs-target="#audiocallModal">Audio
                                    <i class="ri-phone-line float-end text-muted"></i></a>
                                <a class="dropdown-item d-block d-lg-none" href="#" data-bs-toggle="modal"
                                    data-bs-target="#videocallModal">Video <i
                                        class="ri-vidicon-line float-end text-muted"></i></a>
                                <a class="dropdown-item" href="#">Archive <i
                                        class="ri-archive-line float-end text-muted"></i></a>
                                <a class="dropdown-item" href="#">Muted <i
                                        class="ri-volume-mute-line float-end text-muted"></i></a>
                                <a class="dropdown-item" href="">Delete <i
                                        class="ri-delete-bin-line float-end text-muted"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['chat', 'friend'],
}
</script>
