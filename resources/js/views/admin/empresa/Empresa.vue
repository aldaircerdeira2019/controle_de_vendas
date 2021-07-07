<template>
  <div>
    <div class="container">
      <div class="row">
        <Menu />
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Menu from "../components/Menu";
export default {
  name: "Empresa",
  components: { Menu },
};
</script>
