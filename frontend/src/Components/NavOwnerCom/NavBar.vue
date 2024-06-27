<template>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg d-flex justify-content-between">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><b>PENH JET SALON</b></a>
            <!-- Toggle button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <form class="d-flex my-2 my-lg-0 ms-lg-4">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown notification-container" id="dropdown-menu">
                        <a class="nav-link dropdown-toggle text-primary d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="badge-container">
                                <i class="bi bi-bell"></i> <span class="badge bg-danger">99</span>
                            </span>
                        </a>


                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow-lg">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="https://t4.ftcdn.net/jpg/06/08/55/73/360_F_608557356_ELcD2pwQO9pduTRL30umabzgJoQn5fnd.jpg"
                                                alt="User Avatar" class="rounded-circle w-13 h-13"
                                                style="object-fit: cover;">
                                        </div>
                                        <div>
                                            <strong>Veak Khlop</strong>
                                            <div>Check out this interesting article!</div>
                                            <small class="text-muted">1 year ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <hr>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAcZUYZ7y_E5rfCrLNUNDOJEf-0Ii6wgRlyRB1ywNheQdzqjg_muOu9YwnAuq9ZEn50tc&usqp=CAU"
                                                alt="User Avatar" class="rounded-circle w-13 h-13"
                                                style="object-fit: cover;">
                                        </div>
                                        <div>
                                            <strong>Makara Try</strong>
                                            <div>Check out this interesting article!</div>
                                            <small class="text-muted">1 day ago</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {

}
</script>

<style>
.navbar {
    background-color: #fff;
}
</style>