<template>
  <div class="card text-center">
    <div class="card-header">Shipping address</div>
    <div v-if="this.addresses.length > 0">
      <div v-for="(address, index) in addresses" v-bind:key="index">
        <div v-if="address.is_default == 1">
          <div class="card-body">
            <h5 class="card-title">{{ address.specific_address }}</h5>
            <p class="card-text">
              {{ address.ward_address.name_xaphuong }},
              {{ address.province_address.name_quanhuyen }},
              {{ address.city_address.name_city }}
            </p>
            <span class="badge rounded-pill bg-success">Default</span>
          </div>
          <div class="card-footer">
            <button
              type="button"
              class="btn btn-outline-success"
              data-bs-toggle="modal"
              data-bs-target="#address_list"
            >
              Change your address
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="card-body">
        <p class="card-text">You have not add any address to your account</p>
      </div>
      <div class="card-footer">
        <a href="" class="btn btn-outline-success">Add address now</a>
      </div>
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
    fetchAddresses: function (page_url) {
      page_url = page_url || "api/address";
      fetch(page_url)
        .then((res) => res.json())
        .then((res) => {
          this.addresses = res.data;
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>