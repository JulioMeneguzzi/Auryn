<template>
  <form @submit.prevent="send">
    <div class="form-floating mb-3">
      <input
        type="text"
        class="form-control"
        id="nome"
        placeholder="Nome completo"
        required
        v-model="nome"
      />
      <label for="nome">Nome completo</label>
    </div>
    <div class="row gx-3">
      <div class="col">
        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="telefone"
            placeholder="Telefone"
            required
            v-model="telefone"
          />
          <label for="telefone">Telefone</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input
            type="date"
            class="form-control"
            id="nascimento"
            placeholder="Data de nascimento"
            required
            v-model="nascimento"
          />
          <label for="nascimento">Data de nascimento</label>
        </div>
      </div>
    </div>
    <div class="form-floating mb-3">
      <input
        type="email"
        class="form-control"
        id="email"
        placeholder="E-mail"
        required
        v-model="email"
      />
      <label for="email">E-mail</label>
    </div>
    <div class="row gx-3">
      <div class="col">
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control"
            id="senha"
            placeholder="Senha"
            required
            v-model="senha"
          />
          <label for="senha">Crie uma senha</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control"
            id="senha2"
            placeholder="Senha"
            required
            v-model="senha2"
          />
          <label for="senha2">Repita a senha</label>
        </div>
      </div>
    </div>
    <div class="form-floating mb-5">
      <input
        type="text"
        class="form-control"
        id="cpf"
        placeholder="cpf"
        required
        v-model="cpf"
      />
      <label for="cpf">Seu CPF</label>
    </div>
    <button type="submit" class="btn btn-lg btn-primary fs-6 py-3 px-5">Criar conta</button>
  </form>
</template>

<script>
  import Vue from 'vue';
  import CPF from 'cpf';

  export default {
    name: "Formulario",
    data() {
      return {
        cpf: '',
        email: '',
        nascimento: '',
        nome: '',
        senha2: '',
        senha: '',
        telefone: '',
        mensagemdeerro: '',
      }
    },
    methods: {
      send() {
        if (this.senha !== this.senha2) {
          Vue.toasted.show('Senhas são diferentes', { type: 'error', duration: 1500 });
        }

        if (!CPF.isValid(this.cpf)) {
          Vue.toasted.show('CPF é inválido', { type: 'error', duration: 1500 });
        }

        const form = new FormData();
        form.append('cpf', this.cpf);
        form.append('email', this.email);
        form.append('nascimento', this.nascimento);
        form.append('nome', this.nome);
        form.append('senha', this.senha);
        form.append('telefone', this.telefone);

        fetch('http://localhost:8001/usuario', {
          method: 'POST',
          body: form
        }).then(response => {
          if(response.ok) {
            Vue.toasted.show('Conta criada com sucesso', { type: 'success', duration: 1500 });
          } else {
            Vue.toasted.show('Falha ao criar a conta', { type: 'error', duration: 1500 });
          }
        });
      }
    }
  };
</script>