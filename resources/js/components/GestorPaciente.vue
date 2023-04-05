<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chat</div>
<!--  -->
<div class="fb-navbar">
  <div class="fb-navbar__icon">
    <i class="fab fa-facebook"></i>
  </div>
  <div class="fb-navbar__search">
    <input type="text" placeholder="Buscar en Facebook">
    <i class="fas fa-search"></i>
  </div>
  <div class="fb-navbar__menu">
    <i class="fas fa-user"></i>
    <i class="fas fa-comments"></i>
    <i class="fas fa-bell"></i>
  </div>
</div>
<!--  -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
.fb-navbar {
  background-color: #3b5998;
  color: #fff;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 9999;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px;
  height: 60px;
}

.fb-navbar__icon i {
  font-size: 30px;
}

.fb-navbar__search input[type="text"] {
  background-color: transparent;
  border: none;
  border-bottom: 1px solid #fff;
  color: #fff;
  padding: 10px;
  margin-right: 10px;
}

.fb-navbar__search i {
  font-size: 20px;
}

.fb-navbar__menu i {
  font-size: 25px;
  margin-left: 20px;
}

@media (max-width: 768px) {
  .fb-navbar {
    justify-content: center;
  }

  .fb-navbar__search {
    display: none;
  }

  .fb-navbar__menu {
    margin-right: 0;
  }

  .fb-navbar__menu i {
    margin: 0 10px;
  }
}</style>
