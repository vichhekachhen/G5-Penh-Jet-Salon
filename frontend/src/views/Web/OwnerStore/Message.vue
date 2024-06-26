<template>
  <div class="notification-bar bg-white p-2 d-flex justify-content-between align-items-center">
    <div>Notification</div>
    <input type="text" class="form-control w-50" placeholder="Search...">
  </div>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-md-3 sidebar bg-white p-0">
        <div class="contact d-flex align-items-center p-3 border-bottom">
          <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="40" height="40">
          <div>
            <strong>Khav Saroeurn</strong><br>
            <span>Hey! Are u free?</span>
          </div>
        </div>
        <div class="contact d-flex align-items-center p-3 border-bottom">
          <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="40" height="40">
          <div>
            <strong>Makara Try</strong><br>
            <span>Did u come?</span>
          </div>
        </div>
        <div class="contact d-flex align-items-center p-3 border-bottom">
          <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="40" height="40">
          <div>
            <strong>Veak Khlop</strong><br>
            <span>Hey! Free ot?</span>
          </div>
        </div>
        <!-- Add more contacts as needed -->
      </div>
      <div class="col-md-9 chat bg-light d-flex flex-column p-0">
        <div class="chat-header bg-white p-3 d-flex align-items-center border-bottom">
          <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="40" height="40">
          <strong>Veak Khlop</strong>
        </div>
        <div class="chat-body flex-fill p-3 overflow-auto">
          <div class="message d-flex mb-3">
            <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="30" height="30">
            <div class="message-content">
              Brunch was awesome! I loved seeing you! 💕🥂😋
            </div>
          </div>
          <div class="message d-flex mb-3">
            <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="30" height="30">
            <div class="message-content">
              Let's go again soon! Can you send the pic you took of us?
            </div>
          </div>
          <div class="message d-flex mb-3">
            <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="30" height="30">
            <div class="message-content">
              It's #storyworthy<br>
              <img src="/images.jpg" alt="Shared Pic" class="mt-2 rounded" style="width: 100px;">
            </div>
          </div>
          <div class="message d-flex mb-3">
            <img src="/images.jpg" alt="Profile Picture" class="rounded-circle me-3" width="30" height="30">
            <div class="message-content">
              Omg we look great!
            </div>
          </div>
        </div>
        <div class="chat-footer bg-white p-3 border-top d-flex">
          <input type="text" class="form-control rounded-pill" placeholder="Type a message">
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {

}
</script>
<style>
.sidebar {
  border-right: 1px solid #ccc;
}

.contact {
  cursor: pointer;
}

.contact:hover {
  background-color: #f1f1f1;
}

.notification-bar {
  border-bottom: 1px solid #ccc;
}
</style>