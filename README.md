# 📢 AlertSystem

Un plugin para PocketMine-MP 5.28.2 que permite enviar alertas globales a todos los jugadores desde consola o comandos, con configuración personalizable.

---

## 🚀 Características

- Envío de mensajes tipo broadcast a todos los jugadores online.
- Comando `/alert sendtoall <mensaje>` para enviar alertas personalizadas.
- Comando `/alert reload` para recargar la configuración sin reiniciar el servidor.
- Sistema automático de alertas cada cierto intervalo (configurable).
- Permisos separados para enviar y recargar alertas.

---

## 🛠️ Instalación

1. Coloca el zip en la carpeta `plugins/` de tu servidor PocketMine-MP y descomprime el .zip.
2. Asegúrate de estar usando **PocketMine-MP 5.28.2** o superior.
3. Reinicia o recarga el servidor.

---

## ⚙️ Configuración (`config.yml`)

```yaml
prefix: "§7[§cAlert§7] "
interval: 300
