<template>
  <div id="main-content" class="bg-white border row">
    <div class="col-md-12 border-right">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-right">My address</h5>
        <button
          @click="openAdd()"
          data-bs-toggle="modal"
          data-bs-target="#staticBackdrop"
          class="btn btn-outline-success"
        >
          Add new address
        </button>
      </div>
      <hr class="mb-2" />
      <h5>Address list</h5>
      <div v-if="addresses != ''">
        <!-- Modal -->

        <div
          class="modal fade"
          id="staticBackdrop"
          data-bs-backdrop="static"
          data-bs-keyboard="false"
          tabindex="-1"
          aria-labelledby="staticBackdropLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <form @submit.prevent="saveAddress">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">
                    Address: #{{ address.address_id }}
                  </h5>
                  <a type="button">
                    <i class="fa-solid fa-x" data-bs-dismiss="modal"></i>
                  </a>
                </div>
                <div class="modal-body">
                  <div class="input-group input-group-outline mb-3">
                    <select
                      class="form-control"
                      @change="onChangeCity($event)"
                      v-model="address.city"
                      :class="{ ' is-invalid': errors.city }"
                    >
                      <option disabled value="">Select your city</option>
                      <option v-for="city in cities" v-bind:value="city.matp">
                        {{ city.name_city }}
                      </option>
                    </select>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <select
                      class="form-control"
                      @change="onChangeProvince($event)"
                      v-model="address.province"
                      :class="{ ' is-invalid': errors.province }"
                    >
                      <option disabled value="">Select your province</option>
                      <option
                        v-for="province in provinces"
                        v-bind:value="province.maqh"
                      >
                        {{ province.name_quanhuyen }}
                      </option>
                    </select>
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <select
                      class="form-control"
                      v-model="address.ward"
                      :class="{ ' is-invalid': errors.ward }"
                    >
                      <option disabled value="">Select your ward</option>
                      <option v-for="ward in wards" v-bind:value="ward.xaid">
                        {{ ward.name_xaphuong }}
                      </option>
                    </select>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <textarea
                      placeholder="Specific address"
                      type="text"
                      class="form-control"
                      :class="{ ' is-invalid': errors.specific_address }"
                      v-model="address.specific_address"
                    ></textarea>
                  </div>
                  <br />
                  <span>Address type:</span>
                  <div class="form-check mb-3">
                    <input
                      type="radio"
                      class="btn-check"
                      id="success-outlined"
                      value="1"
                      v-model="address.address_type"
                    />
                    <label
                      class="btn btn-outline-success"
                      for="success-outlined"
                      >Home</label
                    >

                    <input
                      type="radio"
                      class="btn-check"
                      id="danger-outlined"
                      value="2"
                      v-model="address.address_type"
                    />
                    <label class="btn btn-outline-success" for="danger-outlined"
                      >Office</label
                    >
                  </div>
                  <span style="color: red" v-if="errors && errors.address_type">
                    {{ errors.address_type[0] }}
                  </span>
                  <div class="form-check form-switch">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="flexSwitchCheckChecked"
                      v-model="address.is_default"
                    />
                    <label class="form-check-label" for="flexSwitchCheckChecked"
                      >Set as default address</label
                    >
                  </div>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- End Modal -->

        <div
          class="d-flex my-4 flex-wrap justify-content-between"
          v-for="(address, index) in addresses"
          v-bind:key="index"
        >
          <div class="p-2">
            <div>
              {{ address.specific_address }}
            </div>
            <div>
              {{ address.ward_address.name_xaphuong }},
              {{ address.province_address.name_quanhuyen }},
              {{ address.city_address.name_city }}
            </div>
            <div
              class="d-flex my-4 flex-wrap"
              v-if="address.is_default == true"
            >
              <div id="default">Default</div>
            </div>
          </div>
          <div class="p-2"></div>
          <div class="p-2">
            <a type="button" href="" class="btn btn-outline-success">Update</a>
            <a
              type="button"
              href=""
              class="btn btn-outline-success"
              v-if="address.is_default != true"
              >Delete address</a
            >
            <div class="d-flex my-4 flex-wrap">
              <button
                disabled
                type="button"
                href=""
                class="btn btn-outline-dark"
                v-if="address.is_default == true"
              >
                Set as default
              </button>
              <button
                type="button"
                href=""
                class="btn btn-outline-success"
                v-else
                @click="setAsDefault(address.address_id)"
              >
                Set as default
              </button>
            </div>
          </div>
        </div>
        <hr />
      </div>
      <div class="p-2" v-else>You have no address yet</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cities: [],
      provinces: [],
      wards: [],
      addresses: [],
      address: {
        address_id: "",
        specific_address: "",
        address_type: "",
        is_default: false,
        city: "",
        province: "",
        ward: "",
      },
      edit: false,
      errors: {},
    };
  },
  created() {
    this.fetchAddresses();
  },
  methods: {
    fetchCity: function (page_url) {
      page_url = page_url || "../api/city";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.cities = res.data;
        })
        .catch((err) => console.log(err));
    },
    fetchAddresses: function (page_url) {
      page_url = page_url || "../api/address";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.addresses = res.data;
        })
        .catch((err) => console.log(err));
    },
    onChangeCity(event) {
      axios
        .get(`../api/province/${event.target.value}`)
        .then((res) => {
          this.provinces = res.data.data;
        })
        .catch((error) => {
          // alert
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "error",
            title: "Oops! Something went wrong",
          });
          // alert
        });
    },

    onChangeProvince(event) {
      axios
        .get(`../api/ward/${event.target.value}`)
        .then((res) => {
          this.wards = res.data.data;
        })
        .catch((error) => {
          // alert
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "error",
            title: "Oops! Something went wrong",
          });
          // alert
        });
    },

    openAdd: function () {
      this.fetchCity();
      if (this.edit === true) {
        this.edit = false;
      }
      this.address.address_id = "";
      this.address.address_type = "1";
      this.address.city = "";
      this.address.is_default = false;
      this.address.province = "";
      this.address.ward = "";
      this.address.specific_address = "";
      this.errors = "";
    },

    saveAddress: function () {
      if (this.edit === false) {
        //add address
        let formData = new FormData();
        formData.append("city", this.address.city);
        formData.append("province", this.address.province);
        formData.append("ward", this.address.ward);
        formData.append("specific_address", this.address.specific_address);
        formData.append("address_type", this.address.address_type);
        formData.append("is_default", this.address.is_default);

        axios
          .post("../api/address", formData)
          .then((response) => {
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "success",
              title: "Add successfully",
            });
            // alert
            this.errors = "";
            $("#staticBackdrop").modal("hide");
            this.fetchAddresses();
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
            // alert
            const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
              },
            });

            Toast.fire({
              icon: "error",
              title: "Oops! Something went wrong",
            });
            // alert
          });
      } else {
      }
    },
    setAsDefault: function (address_id) {
      axios
        .get(`../api/address/${address_id}/edit`)
        .then((res) => {
          // alert
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "success",
            title: "Set address as default",
          });
          // alert
          this.fetchAddresses();
        })
        .catch((error) => {
          console.log(error);
          // alert
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "error",
            title: "Oops! Something went wrong",
          });
          // alert
        });
    },
  },
};
</script>