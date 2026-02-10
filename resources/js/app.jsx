import React from 'react'
import ReactDOM from 'react-dom/client'
import '../css/app.css'

function App() {
  return (
    <div className="min-h-screen bg-linear-to-br from-primary to-accent flex items-center justify-center">
      <div className="text-center">
        <h1 className="text-5xl font-bold text-white mb-4">fauziDev</h1>
        <p className="text-2xl text-secondary">Loading...</p>
      </div>
    </div>
  )
}

const root = ReactDOM.createRoot(document.getElementById('root'))
root.render(<App />)
