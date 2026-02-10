import React from 'react'
import { Link } from 'react-router-dom'

export default function Footer() {
  return (
    <footer id="contact" className="bg-linear-to-r from-primary via-[#FF8C5A] to-accent text-white mt-20">
      {/* Main Footer Content */}
      <div className="container mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-4 gap-8">
        {/* Company Info */}
        <div className="space-y-4">
          <div className="flex items-center space-x-2">
            <div className="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center font-bold">
              <i className="fas fa-code"></i>
            </div>
            <span className="text-2xl font-bold">fauziDev</span>
          </div>
          <p className="text-white/80 text-sm leading-relaxed">
            Solusi pengembangan web profesional untuk mengubah visi digital Anda menjadi kenyataan.
          </p>
          <div className="flex space-x-4">
            <a href="#" className="w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center transition-all">
              <i className="fab fa-facebook-f"></i>
            </a>
            <a href="#" className="w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center transition-all">
              <i className="fab fa-twitter"></i>
            </a>
            <a href="#" className="w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center transition-all">
              <i className="fab fa-instagram"></i>
            </a>
            <a href="#" className="w-10 h-10 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center transition-all">
              <i className="fab fa-linkedin"></i>
            </a>
          </div>
        </div>

        {/* Quick Links */}
        <div className="space-y-4">
          <h3 className="text-lg font-bold">Navigasi</h3>
          <ul className="space-y-2">
            <li><Link to="/" className="text-white/80 hover:text-white transition-all">Beranda</Link></li>
            <li><Link to="/services" className="text-white/80 hover:text-white transition-all">Layanan</Link></li>
            <li><Link to="/portfolio" className="text-white/80 hover:text-white transition-all">Portfolio</Link></li>
            <li><a href="#contact" className="text-white/80 hover:text-white transition-all">Kontak</a></li>
          </ul>
        </div>

        {/* Services */}
        <div className="space-y-4">
          <h3 className="text-lg font-bold">Layanan Kami</h3>
          <ul className="space-y-2">
            <li><a href="#" className="text-white/80 hover:text-white transition-all">Website Development</a></li>
            <li><a href="#" className="text-white/80 hover:text-white transition-all">E-commerce Solutions</a></li>
            <li><a href="#" className="text-white/80 hover:text-white transition-all">Web Application</a></li>
            <li><a href="#" className="text-white/80 hover:text-white transition-all">Digital Transformation</a></li>
          </ul>
        </div>

        {/* Contact Info */}
        <div className="space-y-4">
          <h3 className="text-lg font-bold">Hubungi Kami</h3>
          <div className="space-y-3">
            <div className="flex items-start space-x-3">
              <i className="fas fa-phone mt-1"></i>
              <div>
                <p className="font-semibold">Telepon</p>
                <a href="tel:+62812345678" className="text-white/80 hover:text-white">+62 812 345 678</a>
              </div>
            </div>
            <div className="flex items-start space-x-3">
              <i className="fas fa-envelope mt-1"></i>
              <div>
                <p className="font-semibold">Email</p>
                <a href="mailto:info@fauzidev.com" className="text-white/80 hover:text-white">info@fauzidev.com</a>
              </div>
            </div>
            <div className="flex items-start space-x-3">
              <i className="fas fa-map-marker-alt mt-1"></i>
              <div>
                <p className="font-semibold">Alamat</p>
                <p className="text-white/80">Jakarta, Indonesia</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Divider */}
      <div className="border-t border-white/20"></div>

      {/* Bottom Footer */}
      <div className="container mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between">
        <p className="text-white/80 text-sm text-center md:text-left">
          &copy; 2024 fauziDev. Semua hak dilindungi. Dikembangkan dengan <i className="fas fa-heart text-red-400 mx-1"></i> oleh Tim fauziDev.
        </p>
        <div className="flex space-x-6 mt-4 md:mt-0 text-sm">
          <a href="#" className="text-white/80 hover:text-white transition-all">Kebijakan Privasi</a>
          <a href="#" className="text-white/80 hover:text-white transition-all">Syarat & Ketentuan</a>
          <a href="#" className="text-white/80 hover:text-white transition-all">Sitemap</a>
        </div>
      </div>
    </footer>
  )
}
