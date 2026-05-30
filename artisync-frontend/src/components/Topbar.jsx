import { Search, Bell, User } from 'lucide-react';

const Topbar = () => {
  return (
    <header className="h-20 bg-white/50 backdrop-blur-sm border-b border-gray-200 flex items-center justify-between px-8">
      <div className="flex items-center w-96 bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm">
        <Search size={18} className="text-gray-400 mr-2" />
        <input 
          type="text" 
          placeholder="Rechercher..." 
          className="w-full outline-none bg-transparent"
        />
      </div>

      <div className="flex items-center gap-4">
        <button className="p-2 text-gray-400 hover:text-[#8B5A2B] transition-colors">
          <Bell size={20} />
        </button>
        <div className="w-10 h-10 rounded-full bg-[#D4A373] flex items-center justify-center text-white cursor-pointer shadow-sm">
          <User size={20} />
        </div>
      </div>
    </header>
  );
};

export default Topbar;