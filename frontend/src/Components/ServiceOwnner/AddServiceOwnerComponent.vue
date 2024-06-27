<template>
    <div class="container">
      <div class="d-flex justify-content-end" style="margin-top: 10px; margin-bottom: 10px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">+AddService</button>
      </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            ...
            </div>
        </div>
    </div>
      
      <h1>Create Service</h1>
      <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
          <tr>
            <th>ServiceName</th>
            <th>Description</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr >
            <td>
              <div class="d-flex align-items-center">
                <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                  class="rounded-circle" />
                <div class="ms-3">
                  <p class="fw-bold mb-1"> service.name </p>
                </div>
              </div>
            </td>
            <td>
              <p class="fw-normal mb-1"> service.description </p>
            </td>
            <td>
              <p class="fw-normal mb-1">service.price </p>
            </td>
            <td>
              <p class="fw-normal mb-1">service.duration </p>
            </td>
            <td>
              <button type="button" class="btn btn-primary btn-sm">Edit</button>
              <button type="button" class="btn btn-danger btn-sm">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

</template>