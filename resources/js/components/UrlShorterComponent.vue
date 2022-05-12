<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form class="mt-3" @submit.prevent="submit">
          <h4>Сервис сокращения ссылок</h4>

          <div v-if="!shortUrl">
            <div v-show="error" class="alert alert-danger" role="alert">
              {{ error }}
            </div>

            <div class="mb-3 mt-3">
              <label for="url" class="form-label">Ссылка</label>
              <input id="url" v-model.trim="url" class="form-control" placeholder="Введите ссылку">
            </div>

            <input class="btn btn-primary" type="submit" value="Сократить">
          </div>

          <div v-else>
            <div class="alert alert-success" role="alert">
               Успех! Ваша ссылка сокращена
            </div>

            <div class="mb-3 mt-3">
              <label for="short_url" class="form-label">Короткая ссылка</label>
              <input id="short_url" ref="shortUrl" v-model.trim="shortUrl" class="form-control">
            </div>

            <button class="btn btn-primary" type="button" @click.prevent="copyShortUrl()">Копировать</button>
            <button class="btn btn-secondary" type="button" @click.prevent="shortUrl = ''">Назад</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        url: '',
        shortUrl: '',
        error: ''
      };
    },
    methods: {
      submit() {
        axios.post("http://localhost/api/short-url", { 'url': this.url })
          .then(response => {
            this.hideFormError();

            this.shortUrl = response.data.shortUrl;
          })
          .catch(error => {
            this.error = error.response.data.message;
          });
      },
      copyShortUrl() {
        navigator.clipboard.writeText(this.shortUrl);
        this.$refs.shortUrl.select();
      },
      hideFormError() {
        this.error = '';
      }
    }
  }
</script>
