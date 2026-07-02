# Guia de Configuração no Render.com

## 1. Variáveis de Ambiente Obrigatórias

No painel do **Render**, acesse seu Web Service e vá em:
- **Environment**  
- **Add Environment Variable**

Adicione cada uma destas variáveis (copie exatamente os nomes):

```
DB_DRIVER          = pdo_mysql
DB_HOST            = gateway01.ap-northeast-1.prod.aws.tidbcloud.com
DB_PORT            = 4000
DB_NAME            = sistemaclubeweb
DB_USER            = 2pxmsaj29iFCsGe.root
DB_PASSWORD        = (sua senha do TiDB)
CLOUDINARY_URL     = cloudinary://[seu_token]@[seu_cloud]
```

**⚠️ IMPORTANTE:**
- Não use `BASE_URL` no Render (já está vazia no `index.php`)
- Copie os valores **exatamente** como aparecem no TiDB Cloud
- `DB_DRIVER` SEMPRE deve ser `pdo_mysql`
- `DB_PORT` SEMPRE deve ser `4000` (padrão TiDB)

---

## 2. Validar Conexão

Após adicionar as variáveis:

1. Clique em **Manual Deploy**
2. Aguarde o build terminar
3. Teste a rota raiz: `https://seu-app.onrender.com/`
4. Tente fazer login

Se ainda der erro de conexão, rode este comando local para testar:

```bash
cd seu-projeto
Set-Location "C:\xampp\htdocs\SistemaClubeWeb"
php -r "require 'vendor/autoload.php'; echo getenv('DB_HOST') ? 'OK' : 'FALHOU';"
```

---

## 3. Troubleshooting

### Erro: "The options driver or driverClass are mandatory"
- ✅ Variáveis de ambiente não foram setadas no Render
- ✅ Copie todos os 6 valores acima
- ✅ Após adicionar, sempre clique **Manual Deploy**

### Erro: "CREATE command denied"
- O banco `sistemaclubeweb` não existe no TiDB
- Crie via SQL no TiDB Cloud:
  ```sql
  CREATE DATABASE IF NOT EXISTS sistemaclubeweb;
  ```

### Erro: "Access denied for user"
- Host/user/password incorretos
- Verifique exatamente no painel do TiDB Cloud > Connect

---

## 4. Build Command (Render)

Deixe como padrão:
```
npm install
```

Ou, se usar PHP direto:
```
composer install --no-dev --optimize-autoloader
```

---

## 5. Start Command (Render)

Deixe como padrão do Render para imagens Docker:
- Se usar Dockerfile: deixe em branco (Render usa `EXPOSE 80`)
- Se usar buildpack: `php -S 0.0.0.0:80 -t public`

