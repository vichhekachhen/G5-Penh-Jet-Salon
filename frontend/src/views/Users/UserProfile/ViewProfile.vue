<template>
    <div class="container mt-5">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img :src="user.avatarUrl" alt="User" class="rounded-circle" width="150" />
                                <div class="mt-3">
                                    <h4></h4>
                                    <p class="text-secondary mb-1"></p>
                                    <p class="text-muted font-size-sm"></p>
                                    <button class="btn btn-outline-primary">Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ userAuth.user.name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ userAuth.user.email }}
                                </div>
                            </div>
                            <hr/>
                            <!-- Add more rows for other user data -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

