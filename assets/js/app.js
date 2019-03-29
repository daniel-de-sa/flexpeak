
var globalApp = new Vue({
  el: "#globalApp",
  data:{
    item: ""
  },
  methods:{
    deleteItem(val){
      location.href = "//"+location.hostname+"/flexpeak/"+val+"/delete/"+this.item;
    }
  }
});


var app = new Vue({
  el: '#app',
  mixins: [mixin],
  data: {
    titulo_pagina:"Alunos",
    msg_erro: "Erro: CEP não encontrado",
    nao_encontrado: false
  },

  mounted: function () {
    $("#cep").mask("00.000-000");
  
  },
  methods: {
    cadastroAluno: function(ev){
      var form = {};
      $.each($('#form_aluno').serializeArray(), function() {
          form[this.name] = this.value;
      });
      //Valida a data de nascimento
      if(form.nascimento.length < 10){
        this.nao_encontrado = true;
        this.msg_erro = "Erro: Data de nascimento inválida";
      }else{
        var anoNascimento = (form.nascimento.split('-')).shift();
        var now = new Date;
        if(anoNascimento > now.getFullYear()){
          this.nao_encontrado = true;
          this.msg_erro = "Erro na Data de nascimento: O ano de nascimento não pode ser maior que o ano corrente";
        }else{
          //Valida o CEP
          if (/^[0-9]{2}.[0-9]{3}-[0-9]{3}$/.test(this.cep)) {
            $('#form_aluno').submit();
          }
        }
      }
     
    }
   
  },
  watch:{
    cep:function (val) {
      var self = this;
      if (/^[0-9]{2}.[0-9]{3}-[0-9]{3}$/.test(val)) {
        $.getJSON("https://viacep.com.br/ws/" +val.replace('.','')+ "/json/", function (endereco) {
          if (endereco.erro) {
            self.endereco = {};
            self.nao_encontrado = true;
            self.msg_erro = "Erro: CEP não encontrado";
            return ;
          }else{
            self.nao_encontrado = false;
            self.endereco = endereco;
            $("#numero").focus();
          }
        });
      }
    } 
  }
});