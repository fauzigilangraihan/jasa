import React from 'react'

export default function FloatingWhatsApp() {
  return (
    <a
      href="https://wa.me/62812345678?text=Halo%20fauziDev%2C%20saya%20tertarik%20dengan%20layanan%20Anda"
      target="_blank"
      rel="noopener noreferrer"
      className="fixed bottom-6 right-6 z-40 w-14 h-14 bg-linear-to-br from-green-400 to-green-600 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-all duration-300 animate-pulse-bounce group"
      title="Chat dengan WhatsApp"
    >
      <i className="fas fa-brands fa-whatsapp text-xl group-hover:scale-125 transition-transform"></i>
    </a>
  )
}
