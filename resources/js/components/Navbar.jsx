import React, { useState } from 'react'
import { Link } from 'react-router-dom'

export default function Navbar({ user, theme, toggleTheme }) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)

  return (
    <nav className="fixed top-0 w-full z-50 transition-all duration-300 bg-white/95 dark:bg-slate-950/95 backdrop-blur-md border-b border-slate-200/30 dark:border-slate-800/30">
      <div className="container mx-auto px-4 py-4">
        <div className="flex items-center justify-between">
          {/* Logo */}
          <Link to="/" className="flex items-center space-x-2 group">
            <div className="w-10 h-10 bg-linear-to-br from-primary to-[#FF8C5A] rounded-xl flex items-center justify-center text-white font-bold text-lg group-hover:shadow-lg transition-all duration">
              <i className="fas fa-code"></i>
            </div>
            <span className="text-2xl font-bold bg-linear-to-r from-primary to-accent bg-clip-text text-transparent group-hover:opacity-80 transition-all">
              fauziDev
            </span>
          </Link>

          {/* Desktop Menu */}
          <div className="hidden lg:flex items-center space-x-1">
            <Link to="/" className="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-secondary font-semibold transition-all duration-300 hover:bg-primary/5">
              <i className="fas fa-home mr-2"></i>Beranda
            </Link>
            <Link to="/services" className="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-secondary font-semibold transition-all duration-300 hover:bg-primary/5">
              <i className="fas fa-briefcase mr-2"></i>Layanan
            </Link>
            <Link to="/portfolio" className="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-secondary font-semibold transition-all duration-300 hover:bg-primary/5">
              <i className="fas fa-palette mr-2"></i>Portfolio
            </Link>
            <a href="#contact" className="px-4 py-2 rounded-lg text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-secondary font-semibold transition-all duration-300 hover:bg-primary/5">
              <i className="fas fa-envelope mr-2"></i>Kontak
            </a>
          </div>

          {/* Right Side */}
          <div className="flex items-center space-x-3">
            {/* Theme Toggle */}
            <button
              onClick={toggleTheme}
              className="p-2.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all duration-300 text-primary dark:text-secondary"
            >
              <i className="fas fa-sun hidden dark:block text-lg"></i>
              <i className="fas fa-moon text-lg dark:hidden"></i>
            </button>

            {user ? (
              <>
                {user.isAdmin ? (
                  <Link to="/admin" className="hidden sm:flex items-center px-4 py-2.5 bg-primary text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                    <i className="fas fa-user-shield mr-2"></i>Admin
                  </Link>
                ) : (
                  <Link to="/orders" className="hidden sm:flex items-center px-4 py-2.5 bg-primary text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                    <i className="fas fa-box mr-2"></i>Pesanan
                  </Link>
                )}
                <button className="hidden sm:flex items-center px-4 py-2.5 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-lg font-semibold transition-all duration-300">
                  <i className="fas fa-sign-out-alt mr-2"></i>Keluar
                </button>
              </>
            ) : (
              <>
                <a href="/login" className="hidden sm:flex items-center px-4 py-2.5 text-primary dark:text-secondary hover:bg-primary/10 dark:hover:bg-secondary/10 rounded-lg font-semibold transition-all duration-300">
                  <i className="fas fa-sign-in-alt mr-2"></i>Masuk
                </a>
                <a href="/register" className="hidden sm:flex items-center px-4 py-2.5 bg-primary text-white rounded-lg font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 active:scale-95">
                  <i className="fas fa-user-plus mr-2"></i>Daftar
                </a>
              </>
            )}

            {/* Mobile Menu Toggle */}
            <button
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="lg:hidden p-2.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all"
            >
              <i className="fas fa-bars text-xl text-primary dark:text-secondary"></i>
            </button>
          </div>
        </div>

        {/* Mobile Menu */}
        {mobileMenuOpen && (
          <div className="lg:hidden mt-4 space-y-2 pb-4 border-t border-slate-200/30 dark:border-slate-800/30 pt-4">
            <Link to="/" className="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-primary/10 font-semibold transition-all">
              <i className="fas fa-home mr-2"></i>Beranda
            </Link>
            <Link to="/services" className="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-primary/10 font-semibold transition-all">
              <i className="fas fa-briefcase mr-2"></i>Layanan
            </Link>
            <Link to="/portfolio" className="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-primary/10 font-semibold transition-all">
              <i className="fas fa-palette mr-2"></i>Portfolio
            </Link>
            <a href="#contact" className="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-primary/10 font-semibold transition-all">
              <i className="fas fa-envelope mr-2"></i>Kontak
            </a>
          </div>
        )}
      </div>
    </nav>
  )
}
